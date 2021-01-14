import psycopg2
from datetime import datetime, timedelta

class RobertDatabase:
    def __init__(self):
        self.conn = psycopg2.connect('user=pi password=projetTransverse2020 dbname=robert')
        self.cur = self.conn.cursor()
    def inject_a_mesure(self,waterLevel, photo1, photo2, date, hour):
        self.cur.execute("insert into mesures (eau, photoresistance1, photoresistance2, dat, heure) values("+str(waterLevel)+","+str(photo1)+","+str(photo2)+",'"+date+"',"+str(hour)+")")
        self.conn.commit()
    def update_a_mesure_water(self, waterLevel, date, hour):
        self.cur.execute("update mesures set eau="+str(waterLevel)+" where dat='"+str(date)+"' and heure="+str(hour))
        self.conn.commit()
    def update_a_mesure_photo1(self,photo1, date, hour):
        self.cur.execute("update mesures set photoresistance1="+str(photo1)+" where dat='"+str(date)+"' and heure="+str(hour))
        self.conn.commit()
    def update_a_mesure_photo2(self,photo2, date, hour):
        self.cur.execute("update mesures set photoresistance2="+str(photo2)+" where dat='"+str(date)+"' and heure="+str(hour))
        self.conn.commit()
    def select_all_mesures(self):
        self.cur.execute("select * from mesures")
        return self.cur.fetchall()
    def select_all_mesures_date(self,date):
        self.cur.execute("select * from mesures where dat ='"+str(date)+"' and heure < 20 and heure > 9")
        return self.cur.fetchall()
    def select_a_mesure(self, date, heure):
        self.cur.execute("select * from mesures where dat='"+str(date)+"' and heure="+str(heure))
        return self.cur.fetchall()
    def select_a_mesure_water(self, date, heure):
        self.cur.execute("select eau from mesures where dat='"+str(date)+"' and heure="+str(heure))
        return self.cur.fetchall()[0][0]
    def select_a_mesure_photo1(self, date, heure):
        self.cur.execute("select photoresistance1 from mesures where dat='"+str(date)+"' and heure="+str(heure))
        return self.cur.fetchall()[0][0]
    def select_a_mesure_photo2(self, date, heure):
        self.cur.execute("select photoresistance2 from mesures where dat='"+str(date)+"' and heure="+str(heure))
        return self.cur.fetchall()[0][0]
    def get_day_log(self, date):
        self.cur.execute("select * from logjour where dat='"+str(date)+"'")
        return self.cur.fetchall()
    def create_day_log(self, date):
        self.cur.execute("insert into logjour (eau, dat, pet, etat, feed) values("+str(0)+",'"+str(date)+"',"+str(False)+","+str(0)+","+str(False)+")")
        self.conn.commit()
    def close(self):
        self.conn.close()
    def modify_day_log(self, date, eau, etat, feed, pet):
        self.cur.execute("update logjour set eau="+str(eau)+", etat="+str(etat)+", feed="+str(feed)+", pet="+str(pet)+" where dat='"+str(date)+"'")
        self.conn.commit()
    def modify_day_log_feed(self, date):
        self.cur.execute("update logjour set etat="+str(1)+", feed="+str(True)+" where dat='"+str(date)+"'")
        self.conn.commit()
    def modify_day_log_pet(self, date):
        self.cur.execute("update logjour set etat="+str(1)+", pet="+str(True)+" where dat='"+str(date)+"'")
        self.conn.commit()
    def modify_day_log_water(self, date, water):
        self.cur.execute("update logjour set eau="+str(water)+" where dat='"+str(date)+"'")
        self.conn.commit()   
    def add_streak(self, date):
        self.cur.execute("select * from mesures order by dat desc,heure desc limit 1")
        tab = self.cur.fetchall()[0]
        if len(tab) > 0 :
            wat = tab[0]
            if str(tab[3]) == str(datetime.now().date()) : #and wat > 0:
                self.cur.execute("select * from logjour where dat='"+str(date)+"'")
                tab = self.cur.fetchall()[0]
                if len(tab)>0:
                    if tab[1] == 1 :
                        self.cur.execute("select * from streak order by dat_start desc limit 1")
                        tab = self.cur.fetchall()[0]
                        if len(tab)>0 :
                            if tab[0] + timedelta(days=tab[1]) == date :
                                self.cur.execute("update streak set val=val + 1 where dat_start = '"+str(tab[0])+"'")
                                self.conn.commit()
                                return True
        self.cur.execute("insert into streak (dat_start, val) values('"+str(date)+"', 1)")
        self.conn.commit()
        return True
