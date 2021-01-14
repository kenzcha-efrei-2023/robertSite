import serial
from database import RobertDatabase
from datetime import datetime

class ArduinoRobert:
    def __init__(self, port):
        self.arduino = serial.Serial(port,115200, timeout=.1)
    def get_mesures_from_arduino(self):
        cond = True
        if (datetime.now().hour > 9 and datetime.now().hour < 20):
            self.arduino.write([0])
        else:
            self.arduino.write([3])
        while cond:
            database = RobertDatabase()
            data = self.arduino.readline()[:-2] 
            if data:
                datab = str(data).split(" ")
                date = str(datetime.now().date())
                heure = datetime.now().hour
                mesnow = database.select_a_mesure(date, heure)
                print(datab)
                if (datab[0]=="b'w"):
                    if (len(mesnow)!=0):
                        database.update_a_mesure_water(datab[1].split("'")[0],date,heure)
                        if datetime.now().hour == 20:
                            database.modify_day_log_water(datetime.now().date(), datab[1].split("'")[0])
                    else:
                        database.inject_a_mesure(datab[1].split("'")[0],0,0,date,heure)
                elif (datab[0]=="b'p1"):
                    if (len(mesnow)!=0):
                        database.update_a_mesure_photo1(datab[1].split("'")[0],date,heure)
                    else:
                        database.inject_a_mesure(0,datab[1].split("'")[0],0,date,heure)
                elif (datab[0]=="b'p2"):
                    if (len(mesnow)!=0):
                        database.update_a_mesure_photo2(datab[1].split("'")[0],date,heure)
                    else:
                        database.inject_a_mesure(0,0,datab[1].split("'")[0],date,heure)
                    cond = False
            database.close()
    def move_back_robert(self, date):
        database = RobertDatabase()
        db = database.select_all_mesures_date(str(date))
        step = 0
        for tupl in db :
            if tupl[1]>tupl[2] :
                step = step + 1
            else:
                step = step - 1
        if (step > 0):
            self.arduino.write([1, step])
        else :
            self.arduino.write([2, -step])
        database.close()

def streak():
    

arduino = ArduinoRobert('/dev/ttyACM0')
if datetime.now().minute == 0:
    arduino.get_mesures_from_arduino()
    if datetime.now().hour == 20:
        #update location
        arduino.move_back_robert(datetime.now().date())
        database = RobertDatabase()
        #add 1 to streaks
        database.add_streak(datetime.now().date())
        database.close()
        
