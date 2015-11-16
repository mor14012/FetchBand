#include <SoftwareSerial.h>

SoftwareSerial Bluetooth(10, 11); //RX, TX
int LED=13; 
int BUZZER=9;
char Data; 
boolean alarmLed, alarmBuzzer, state;
int counter=0;

int notes []  = {1047, 622, 831, 622, 932, 622, 784, 622, 1245, 622, 831, 622, 932, 622, 1109, 622, 1047, 622, 1245, 622, 1661, 831, 932, 831};

void setup() {
  Bluetooth.begin(9600);
  Bluetooth.println("Bluetooth ON");
  pinMode(10, INPUT);
  pinMode(11, OUTPUT);
  pinMode(LED,OUTPUT);
  pinMode(BUZZER, OUTPUT);
}

void loop() {
  if (Bluetooth.available()){
    Data = Bluetooth.read();
    if(Data=='4'){
      alarmLed = false;
      alarmBuzzer = false;
      state = false;
      counter = 0;
    }
    if(Data=='1'){
      alarmLed = true;
    }
    if(Data=='2'){
      alarmBuzzer = true;
    }
    if(Data=='3'){
      alarmLed = true;
      alarmBuzzer = true;
    }
  }
  
  if(alarmLed){
    if(state==true){
      digitalWrite(LED,0);
      state = false;
      }
    else{
      digitalWrite(LED,1);
      state = true;
      }     
  }
  else{
    digitalWrite(LED, 0);
  }
  if(alarmBuzzer){
    tone(BUZZER, notes[counter], 475);
    counter++;
    if(counter==24)
      counter = 0;
  }
  delay(500);
}

