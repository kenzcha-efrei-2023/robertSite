from crontab import CronTab

cron = CronTab(user='pi')
job = cron.new(command='python3 /home/pi/Desktop/RobertAssets/mesure_arduino.py')
job.hour.every(1)
print("ok")
cron.write()