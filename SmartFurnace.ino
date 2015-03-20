// by Belmin Alić
#include <SPI.h>
#include <Ethernet.h>
#include <Servo.h>

byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};
IPAddress ip(192, 168, 1, 125);
EthernetServer server(80);

Servo airOutlet;
int pos=0;

int temp1pin=2;
int tempC1, tempC2;

void setup() {
  
  Serial.begin(9600);
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("Server is at: ");
  Serial.println(Ethernet.localIP());
  
  randomSeed(10);
  airOutlet.attach(9);
}

void loop() {
  
  //tempC1 = (5.0 * analogRead(temp1pin) * 100.0) / 1024;  
  tempC1=random(22,26);// should be LM35, but is broken
  Serial.print("Sobna temperatura = ");
  Serial.print(tempC1);
  Serial.print(" C");
  Serial.println();
  tempC2=random(390,420);  //should be Thermocouple K-type temperature sensor
  Serial.print("Temperatura Peci = ");
  Serial.print(tempC2);
  Serial.print(" C");
  Serial.println();

  EthernetClient client = server.available();
  if (client) {
    Serial.println("You have a new client.");
    boolean currentLineIsBlank = true;    // an http request ends with a blank line
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        Serial.write(c);
        // if you've gotten to the end of the line (received a newline
        // character) and the line is blank, the http request has ended,
        // so you can send a reply
        if (c == '\n' && currentLineIsBlank) {
          // send a standard http response header
          client.println("HTTP/1.1 200 OK");
          client.println("Access-Control-Allow-Origin: *");
          client.println("Content-Type: application/json;charset=utf-8");
          client.println("Server: Arduino");
          client.println("Connnection: close");
          client.println();
          client.println("{");
          client.print("\"roomTemperature\": \"");
          client.print(tempC1);
          client.println("\",");
          client.print("\"furnaceTemperature\": \"");
          client.print(tempC2);
          client.println("\"");
          client.print("}");
          client.println();
          break;
        }
        if (c == '\n') {
          // you're starting a new line
          currentLineIsBlank = true;
        }
        else if (c != '\r') {
          // you've gotten a character on the current line
          currentLineIsBlank = false;
        }
      }
    }
    
    // close the connection:
    client.stop();
    Serial.println("Your client disconnected.");
  }
  
  if (tempC1 < 22) airOutlet.write(0);  // max opened air outlet
  else if (tempC1== 22 || tempC1== 23 || tempC1== 24) airOutlet.write(45);
  else if (tempC1== 25 || tempC1== 26 || tempC1== 27) airOutlet.write(90);
  else if (tempC1== 28 || tempC1== 29 || tempC1== 30) airOutlet.write(135);
  else if (tempC1 > 30) airOutlet.write(180); // closed air outlet
  delay(500);
}

