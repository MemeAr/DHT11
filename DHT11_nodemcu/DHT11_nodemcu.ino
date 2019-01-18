// Déclaration des librairies
#include <DHT.h>                      // pour communiquer avec le capteur DHT
#include <ESP8266WiFi.h>              // pour le support du wifi
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>        // pour utliser le wifi

// Préparation du capteur DHT
#define DHTPIN 2                      // broche sur laquelle est raccordée la data du capteur (la broche 'D4' du NodeMcu correspond à la broche 2 de l'arduino)
#define DHTTYPE DHT11                 // précise la référence du capteur DHT (DHT11 ou DHT21 ou DHT22)
DHT dht(DHTPIN, DHTTYPE);             // Initialisation du capteur DHT

// Initialisation du wifi
ESP8266WiFiMulti WiFiMulti;           

// fonction de démarrage
void setup() {
  
  // Démarrage du bus série
  Serial.begin(115200);               // vitesse
  Serial.println("Bonjour");          // écriture d'un petit message...
  Serial.println("DHT11 + VPS");
  Serial.println("");

  dht.begin();                        // Démarrage du capteur DHT11

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("iPhone de meme", "meme1234");     // Connexion au réseau wifi

}

// boucle infinie
void loop() {
  
  delay(10000);                        // attendre 10 secondes

  float t = dht.readTemperature();    // mesurer la température (en ° Celsius)
  float h = dht.readHumidity();       // mesurer l'humidité (en %)
  
  if (isnan(h) || isnan(t)) {         // test si des valeurs ont été récupérées
    
    // s'il y a un problème...
    
    Serial.println("Failed to read from DHT sensor!");    // affiche un message d'erreur
    return;                           // quitte pour retenter une lecture
    
  } else {

    // si tout va bien...

    // conversion des valeurs en entier
    int temp = int(t);
    int humi = int(h);
  
    // affichage des valeurs dans le bus série
    Serial.print("Temperature : ");
    Serial.print(temp);
    Serial.print(" *C\t");
    Serial.print("Humidité : ");
    Serial.print(humi);
    Serial.println(" %");

    // envoi des données vers internet
    if((WiFiMulti.run() == WL_CONNECTED)) {   // Si le wifi est connecté
      
          Serial.println("Connexion wifi ok");
          
          HTTPClient http;                    // préparation d'une requète HTTP au serveur

          Serial.print("HTTP begin... ");
          http.begin("http://51.75.126.42/DHT11/store_temp.php");   // connexion au serveur
          
          http.addHeader("Content-Type", "application/json");    // envoi d'un entête pour préciser notre format de données : json
          
          String data = "{\"temperature\":\"" + String(temp) + "\",\"humidite\":\"" + String(humi) + "\"}";    // préparation du json {"temperature":"22","humidite":"55"}
          Serial.println(data);
          
          int httpCode = http.POST(data);    // envoi les données et récupère un code de retour
          
          if(httpCode == 200 ) {              // si le code de retour est bon (200)
             Serial.println("POST : ok");
          } else {                            // si le code de retour n'est pas bon (différent de 200)
             Serial.print("POST : failed, error : ");
             Serial.println(http.errorToString(httpCode).c_str());
          }
          http.end();                    // on ferme la connexion au serveur
    } else  {
        Serial.println("Echec connexion wifi");
    }
  }
}