

from entityClass import *
from relicClass import *
playerName = input("Quel est votre nom? ")
player = Entity(playerName, 10, 100, 0, 0.25, 2)

def roundplay(entity):
    import random
    num = random.random()
    if num > entity.cChance:
        print("Coup normal")
        return entity.damage
        
    else: 
        print("Coup critique!")
        return entity.damage*entity.cDamage
        
for encountered in range(1):
    if encountered <= 0:
        print("Vous n'avez encore rencontré aucun démon")
    else:
        print(f"Vous avez tué {encountered} démon(s)")
    encountered = encountered + 1
    import random
    import string

    def get_random_string(length):
    # choose from all lowercase letter
        letters = string.ascii_lowercase
        result_str = ''.join(random.choice(letters) for i in range(length))
        return result_str

    bossName = get_random_string(6)
    bossDamage = 7+(encountered*5)
    bossHp = 100+(encountered*50)
    bossArmor = 0+(encountered)
    bossCritChance = 0+(encountered/100)
    bossCritDamage = 0+(encountered/50)
    boss = Entity(bossName, bossDamage, bossHp, bossArmor, bossCritChance, bossCritDamage)
    print(f"Affrontement {player.name}, vous rencontrez {boss.name}")
    def fullRound(player, boss):
        while player.hp >= 0 and boss.hp >= 0:
            damageTakenFromPlayer = roundplay(player)
            print(f"{boss.name} subit {damageTakenFromPlayer} pts de dégats")
            boss.hp = boss.hp - damageTakenFromPlayer
            print(f"{boss.name} n'a plus que {boss.hp} hp")

            damageTakenFromBoss = roundplay(boss)
            print(f"Vous subissez  {damageTakenFromBoss} pts de dégats")
            player.hp = player.hp - damageTakenFromBoss
            print(f"Il vous reste {player.hp} hp")
            if player.hp <= 0:
                print("Vous etes mort")
                break
            elif boss.hp <= 0:
                print("Le boss est mort")
                break
            else:
                 print("Nouveau round")
    fullRound(player, boss)
