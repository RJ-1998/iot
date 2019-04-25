#include<SoftwareSerial.h>
SoftwareSerial esp(1,0); //For two way communication between server and esp8266 module

//WiFi Settings

// Set up macros for wifi and connection.
#define ssid "rishabh"    // SSID
#define PASS "jain1234"      // Network Password
#define HOST "192.168.43.241"  // Webhost
//-------------------------------

//PIR Settings

//the time we give the sensor to calibrate (10-60 secs according to the datasheet)
int calibrationTime = 15;   

//the amount of milliseconds the sensor has to be low 

boolean lockLow = true;
//boolean takeLowTime;
int pirPin = 3;//the digital pin connected to the PIR sensor's output
int ledPin = 13;//for first led output
int motion = 2; //just for initialisation purpose
int long count = 0;

// Begin Setup
void setup(){
  esp.begin(9600);   //change it
  pinMode(pirPin, INPUT);
  pinMode(ledPin, OUTPUT);
  digitalWrite(pirPin, LOW);
  esp.println("AT");
  delay(1000);
  if(esp.find("OK")){
    //connectWiFi();
    esp.println("AT+CWMODE=1");
    String cmd="AT+CWJAP=\"";
    cmd+=ssid;
    cmd+="\",\"";
    cmd+=PASS;
    cmd+="\"";
    esp.println(cmd);
    delay(15000);
    
  }
}

void loop(){
 
  switch(digitalRead(pirPin) == HIGH) {
      case 1:
             delay(100);
             
             if(lockLow){
                  digitalWrite(ledPin, HIGH);
                  lockLow = false;
                  esp.println("Motion detected ");
                  String cmd = "AT+CIPSTART=\"TCP\",\""HOST"\",80";
                  esp.println(cmd);
                  delay(100);
                  String cd = "GET /arduino/add_data.php?motionornot=";
                  cd += 1;
                  cd += " HTTP/1.1\r\nHost: 192.168.43.241\r\n\r\n\r\n";
                  delay(2000);
                  esp.print("AT+CIPSEND=");
                  esp.println(cd.length());
                  delay(1000);
                  esp.print(cd);
                  delay(200);
             }
          break;

    case 0:
            delay(100);
           
            
            if(!lockLow){
                  digitalWrite(ledPin, LOW);
                  lockLow = true;
                  esp.println("motion ended");
                  String cmd = "AT+CIPSTART=\"TCP\",\""HOST"\",80";
                  esp.println(cmd);
                  delay(100);
                  String cd = "GET /arduino/add_data.php?motionornot=";
                  cd += 0;
                  cd += " HTTP/1.1\r\nHost: 192.168.43.241\r\n\r\n\r\n";
                  delay(2000);
                  esp.print("AT+CIPSEND=");
                  esp.println(cd.length());
                  delay(1000);
                  esp.print(cd);
                  delay(200);
            }
         break;
     default:
      delay(100);
      digitalWrite(ledPin, LOW);
      break;
  }
}

