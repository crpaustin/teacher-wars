# Teacher Wars
Claim your monopoly in the teacher school supply society.

### Usage
Put the files onto a web server running PHP and append your web server url with /teacher-wars.

### How to Play
Teacher Wars is a game about buying low and selling high. You start with only a few dollars and a considerable debt. In order to pay off this debt, you will need to buy and sell school supplies on the market. The prices of these supplies fluctuates often and some locations buy certain items for more money than other locations. 

After entering your name, you will be presented with the main screen. There is a list of stats at the top as well as a few tabs, each with a specific set of functions: 
* The stats include your name, current location in the game, current money, the number of the day, your current debt, and your respect. All of these should be self-explanatory except for the last one. Your respect is a value that determines how close you are to being fired. This begins at 20 and goes down every time you get caught breaking the rules.
* The first tab is the market of the current location. You can buy and sell materials here for their current market value.
* The second tab is your accessible locations. Until you've accrued enough money, you won't be able to go anywhere other than the parking lot. Click "Stay Here" to stay in the parking lot and move forward one day.
* The third tab is where you upgrade your stage in the game. This affects your ability to travel to different locations and buy more expensive materials.
* The fourth tab is your bank. At the beginning of the game, you will have a debt of $1500 and will need to earn the money to pay off this debt. Be warned, your debt increases by 10% every day. Wait too long to pay it off and you will go bankrupt.
* The last tab is for settings. As of right now, the only option is to reset your game.

There are also random events throughout the game. These include surpluses and shortages of materials and getting caught with contraband items in the school. Surpluses and shortages will cause the prices of certain materials to rise or fall accordingly, while getting caught with contraband requires that you either pay up or try to talk your way out of it. If you fail to do so, you will lose respect.

To win the game, you must last 100 days without going bankrupt or being fired. However, if your debt gets too high, you will go bankrupt and lose the game. If your respect drops to 0, you will be fired.

### About the Code
I made this game during my senior year of high school. I was in a Web Design class and had already finished the class work, so I began working on a project of my own. Teacher Wars is inspired by an old Palm OS game called Space Trader. It's the same idea, only you fly a spaceship, buying and selling minerals and trying to avoid space pirates. I decided to recreate the game using a combination of HTML, CSS, JavaScript, and PHP. The webpage layout and design are made using HTML and CSS, and the functionality is created with a combination of JavaScript and PHP.

The coolest thing for me while working on this project was being able to use AJAX (Asynchronous JavaScipt and XML) to update the webpage dynamically. This allows me to use the current game stats, which are handled by PHP, to create JavaScript events, such as a popup box that tells you when you don't have enough money to buy an item. This is all done without refreshing the web page. The only time the webpage is refreshed is when a new day starts. This allows the PHP code to handle the current stats, update the debt and check for a win or lose state. Everything else on the page, such as the buttons and anti-cheat, are handled by JavaScript once PHP hands over the current game stats.

This project took about two weeks to finish, and it's nowhere near perfect. However, it allowed me to take an idea from start to finish, learn new things about each language as well as programming in general, and allowed me to relive a childhood memory.
