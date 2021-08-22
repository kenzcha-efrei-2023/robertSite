class colors:
    GREEN = '\u001b[32m'
    WHITE= '\u001b[37m'

def print_top():
    print(colors.GREEN+".-------.        ,-----.     _______       .-''-.  .-------. ,---------.")  
    print("|  _ _   \     .'  .-,  '.  \  ____  \   .'_ _   \ |  _ _   \\          \\") 
    print("| ( ' )  |    / ,-.|  \ _ \ | |    \ |  / ( ` )   '| ( ' )  | `--.  ,---'")
    print("|(_ o _) /   ;  \  '_ /  | :| |____/ / . (_ o _)  ||(_ o _) /    |   \\")  
    print("| (_,_).' __ |  _`,/ \ _/  ||   _ _ '. |  (_,_)___|| (_,_).' __  :_ _:")   
    print("|  |\ \  |  |: (  '\_/ \   ;|  ( ' )  \'  \   .---.|  |\ \  |  | (_I_)")  
    print("|  | \ `'   / \ `'/  \  ) / | (_{;}_) | \  `-'    /|  | \ `'   /(_(=)_)")  
    print("|  |  \    /   '. \_/``'.'  |  (_,_)  /  \       / |  |  \    /  (_I_)")   
    print("''-'   `'-'      '-----'    /_______.'    `'-..-'  ''-'   `'-'   '---'")   
    print(colors.WHITE)
    print("Projet transverse 2020-2021")
    print("Le Robot qui vous fait voir la vie en "+colors.GREEN+"vert"+colors.WHITE+" !")

def print_sep():
    print("___________________")
    print()

def print_feed():
    print_sep()
    print("(づ ♥෴♥ )づ 'Merci pour le repas !!!'")
    print("Vous avez donne a manger a Robert ! Il est super joyeux maintenant !")

def print_pet():
    print_sep()
    print("(づ ♥෴♥ )づ 'Merci d'avoir joue avec moi !!!'")
    print("Vous avez joue avec Robert ! Il est super joyeux maintenant !")
    
def print_notfeed():
    print_sep()    
    print("(っ´෴｀ς) 'Desole ... J'ai plus faim'")
    print("Robert a deja mange aujourd'hui! Essayez demain !")

def print_notpet():
    print_sep()
    print("(っ´෴｀ς) 'Desole ... Je suis fatigue'")
    print("Robert n'est plus d'humeur a jouer aujourd'hui! Essayez demain !")
    
def print_bottom():
    print_sep()
    print("Au revoir et Merci !!")
    print()
    print()

def print_state(happy, wat):
    print_sep()
    print("Aujourd'hui, Robert est triste ! Nourissez le ou jouez avec lui pour lui remonter le moral !" if not happy else "Aujourd'hui, Robert est d'humeur joyeuse ! Il vous remercie !")
    print("Le niveau d'eau de la bassine est suffisante !" if wat else "Le niveau d'eau de la bassine commence a etre bas ! Veuillez la remplir d'eau !")