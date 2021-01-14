from gfxhat import lcd, backlight, touch
import time
from PIL import Image, ImageFont, ImageDraw

touch.enable_repeat(False)

def display_image(path) :
    lcd.clear()
    image = Image.open(path)
    rgb = image.convert('RGB')
    w, h = image.size
    for i in range(w) :
        for j in range(h) :
            r, g, b = rgb.getpixel((i, j))
            if r + g + b < 100  :
                lcd.set_pixel(i,j,1)
    lcd.show()

def turn_off_screen():
    backlight.set_all(0, 0, 0)
    backlight.show()
    lcd.clear()
    lcd.show()

def set_screen_color(r, g, b) :
    backlight.set_all(r,g,b)
    backlight.show()

def anim(name, nbFrame, timeframe):
    for i in range(1,nbFrame+1):
        display_image('./'+name+str(i)+'.png')
        time.sleep(timeframe)

def boot_animation():
    test_buttons()
    set_screen_color(218, 247, 166)
    anim('animationDebut', 6, 0.1)
    display_image('./animationDebut6.png')
    time.sleep(1)
    
def shrug_animation():
    set_screen_color(255,183,5)
    anim('shrug',9,0.1)
    display_image('./notPossible.png')
    time.sleep(1)
    
def menu_back():
    set_screen_color(255,255,255)
    anim('menuBack',2,0.5)

def menu_feed():
    set_screen_color(255,255,255)
    anim('menuFeed',2,0.5)
    
def menu_state():
    set_screen_color(255,255,255)
    anim('menuState',2,0.5)
    
def menu_pet():
    set_screen_color(255,255,255)
    anim('menuPet',2,0.5)

def idle(happy, healthy):
    if happy and healthy:
        set_screen_color(99,232,28)
    elif happy or healthy :
        set_screen_color(232,198,28)
    else :
        set_screen_color(232,28,28)
    anim(('happy'if happy else 'sad')+('Healthy' if healthy else 'Thirsty'),2,0.3)

def eat():
    set_screen_color(99,232,28)
    anim('eating',10,0.2)
    happy()

def happy():
    set_screen_color(99,232,28)
    anim('happy',2,0.5)
    anim('happy',2,0.5)

def pet():
    set_screen_color(255,0,255)
    anim('pet',8,0.2)
    happy()
    
def bye():
    set_screen_color(255,255,255)
    anim('animationFin',2,0.5)
    anim('animationFin',2,0.5)

def sleepy():
    set_screen_color(255,0,255)
    anim('sleep',9,0.3)
    anim('sleep',9,0.3)

def led_anim(index):
    touch.set_led(index,1)
    time.sleep(0.1)
    touch.set_led(index,0)

def test_screen():
    boot_animation()
    menu_back()
    menu_back()
    menu_pet()
    menu_pet()
    menu_state()
    menu_state()
    menu_feed()
    menu_feed()
    bye()
    idle(True,True)
    idle(True,True)
    idle(True,False)
    idle(True,False)
    idle(False,True)
    idle(False,True)
    idle(False,False)
    idle(False,False)
    shrug_animation()
    eat()
    pet()
    sleepy()
    turn_off_screen()
    
def test_buttons():
    for i in range (6):
        led_anim(i)