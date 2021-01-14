from screen_operation import led_anim, display_image, turn_off_screen, boot_animation,shrug_animation,menu_back,menu_feed,menu_state,menu_pet,idle,eat,happy,pet,bye,sleepy
from gfxhat import touch
import time
from database import RobertDatabase
from datetime import datetime
from terminal_prints import print_top, print_feed, print_notpet, print_notfeed, print_pet, print_bottom, print_state

state_but = ['up', 'down', 'nada', 'nada', 'power', 'nada']
cur_state = 'off'
cur_but = 'nada'

def handle_touch(ch, event):
    global cur_but
    if event == 'press':
        led_anim(ch)
        cur_but = state_but[ch]

def state_menu():
    global cur_but
    global cur_state
    if cur_but == 'power' and cur_state=='off':
        boot_animation()
        print_top()
        cur_state='menu_back'
    elif (cur_but == 'up' or cur_but == 'nada') and cur_state=='menu_back':
        menu_back()
    elif cur_but == 'power' and cur_state=='menu_back':
        bye()
        print_bottom()
        turn_off_screen()
        cur_state='off'
    elif cur_but == 'down' and cur_state=='menu_back':
        cur_state = 'menu_pet'
        menu_pet()
    elif cur_but == 'nada' and cur_state == 'menu_pet':
        menu_pet()
    elif cur_but == 'up' and cur_state=='menu_pet':
        cur_state = 'menu_back'
        menu_back()
    elif cur_but == 'down' and cur_state=='menu_pet':
        cur_state = 'menu_state'
        menu_state()
    elif cur_but == 'power' and cur_state == 'menu_pet':
        pet_robert()
        menu_pet()
    elif cur_but == 'nada' and cur_state == 'menu_state':
        menu_state()
    elif cur_but == 'up' and cur_state=='menu_state':
        cur_state = 'menu_pet'
        menu_pet()
    elif cur_but == 'down' and cur_state=='menu_state':
        cur_state = 'menu_feed'
        menu_feed()
    elif cur_but == 'power' and cur_state == 'menu_state':
        state_robert()
        menu_state()
    elif cur_but == 'nada' and cur_state == 'menu_feed':
        menu_feed()
    elif cur_but == 'up' and cur_state=='menu_feed':
        cur_state = 'menu_state'
        menu_state()
    elif cur_but == 'down' and cur_state=='menu_feed':
        menu_feed()
    elif cur_but == 'power' and cur_state == 'menu_feed':
        feed_robert()
        menu_feed()
    cur_but='nada'

def pet_robert():
    rob = RobertDatabase()
    if len(rob.get_day_log(datetime.now().date())) == 0 :
        rob.create_day_log(datetime.now().date())
        rob.modify_day_log_pet(datetime.now().date())
    else :
        if rob.get_day_log(datetime.now().date())[0][3] :
            shrug_animation()
            print_notpet()
        else :
            pet()
            print_pet()
            rob.modify_day_log_pet(datetime.now().date())
    rob.close()
    

def feed_robert():
    rob = RobertDatabase()
    if len(rob.get_day_log(datetime.now().date())) == 0 :
        rob.create_day_log(datetime.now().date())
        rob.modify_day_log_feed(datetime.now().date())
    else :
        if rob.get_day_log(datetime.now().date())[0][2] :
            print_notfeed()
            shrug_animation()
        else :
            eat()
            print_feed()
            rob.modify_day_log_feed(datetime.now().date())
    rob.close()

def state_robert():
    rob = RobertDatabase()
    dl = rob.get_day_log(datetime.now().date())
    me = rob.select_all_mesures_date(datetime.now().date())
    happy = False
    wat = True
    if len(dl) == 1 :
        happy = dl[0][1] == 1
    if len(me) :
        wat = me[0][len(me[0] -1)] > 100
    idle(happy, wat)
    idle(happy, wat)
    idle(happy, wat)
    print_state(happy, wat)

    rob.close()


for i in range(6):
    touch.on(i, handle_touch)

turn_off_screen()
    
while(True):
    state_menu()
    time.sleep(0.5)
    