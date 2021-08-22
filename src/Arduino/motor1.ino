int Moteur1 = 4;
int Moteur2 = 5;
int Water_sensor = 18;
int photo1 = 19;
int photo2 = 20;
int delay_mesure = 10;
int lu;

void setup() {
  Serial.begin(115200);
  pinMode(Moteur1, OUTPUT);
  pinMode(Moteur2, OUTPUT);
}

void loop() {
  int i = 0;
  bool cond = false;
  while (Serial.available()){
    lu = int(Serial.read());
    if (i == 0){
      if (lu == 0 || lu == 3){
        Serial.println("w "+String(read_water()));
        Serial.println("p1 "+String(read_photo1()));
        Serial.println("p2 "+String(read_photo2()));
        if (lu == 0){
           bouger_robert();
         }
      }
      cond = lu == 1;
    }
   
    else if (cond && i == 1){
      motor_avance();
      attend(lu);
      motor_stop();
    }
    else if (!cond && i == 1 && lu != 3){
      motor_recule();
      attend(lu);
      motor_stop();
    }
    i++;
   }
  attend(1);
}

void motor_avance(){
  digitalWrite(Moteur1, HIGH);
  digitalWrite(Moteur2, LOW);
}

void motor_stop(){
    digitalWrite(Moteur1, LOW);
    digitalWrite(Moteur2, LOW);
}

void motor_recule(){
  digitalWrite(Moteur1, LOW);
  digitalWrite(Moteur2, HIGH);
}

void bouger_robert(){
   if(read_photo1()>read_photo2()){
    motor_avance();
    attend(1);
    motor_stop();
    }
   else{
    motor_recule();
    attend(1);
    motor_stop();
    }
}



void attend(int sec){
  delay(sec*1000); 
 }

int read_water(){
    return analogRead(Water_sensor);
}

int read_photo1(){
    return analogRead(photo1);
 }
int read_photo2(){
    return analogRead(photo2);
 }
