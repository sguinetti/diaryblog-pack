<?php
/**
 * @package Hello Top 100 Movie Quotes
 * @version 0.1.1
 */
/*
Plugin Name: Hello Top 100 Movie Quotes
Plugin URI: http://wordpress.org/plugins/hello-top-100-movie-quotes/
Description: This plugin is based and in code pretty much the same with Hello Dolly plugin, and since I am movie freak, this is my paying homage to all those awesome movies. The second functionality of this plugin: It hides Hello Dolly via CSS :) Quotes taken from: http://www.imdb.com/list/nnZKWPzNk5A/
Author: Milan Ivanovic
Version: 0.1.1
Author URI: http://lanche86.com
*/

function hello_movie_quotes() {
$all_quotes = "Frankly my dear I don't give a damn.
I'm going to make him an offer he can't refuse.
May the force be with you.
You talkin' to me?
Here's looking at you kid.
You don't understand! I coulda had class, I coulda been a contender, I coulda been somebody, instead of a bum, which is what I am.
Rosebud.
Toto, I've a feeling we're not in Kansas anymore.
I drink your milkshake. I drink it up.
Open the pod bay doors HAL.
Mein Fuhrer, I can walk!
Mama always said life is like a box of chocolates, you never know what you're gonna get.
We'll always have Paris.
Take your stinking paws of me you damn dirty apes.
No, I am your father.
Bond. James Bond.
Remember, remember the fifth of November.
My name is Inigo Montoya. You killed my father. Prepare to die.
Stella! Hey Stella!
Some men just want to watch the world burn.
You are a toy!
Made it ma, top of the world.
My precious.
Hakuna Matata
I'm walking here!
Have you ever danced with the devil in the pale moonlight.
It's alive. It's alive!
Gentlemen, you can't fight in here; this is the War Room.
Of all the gin joints, in all the towns, in all the world, she walks into , mine.
What's the most you ever lost on a coin toss?
Soylent green is people.
After all, tomorrow is another day.
You've got to ask yourself one question: 'Do I feel lucky?' Well, do ya, punk?
A boy's best friend is his mother.
They're here already! You're next! You're next, You're next...!
There's no crying in baseball.
Listen to them. Children of the night. What music they make.
I see dead people.
I'm the king of the world.
Go ahead, make my day.
Play it Sam, play as time goes by.
Here's Johnny!
I'm mad as hell, and I'm not going to take it anymore.
Keep your friends close, but your enemies closer.
There's no place like home.
I'll be back.
Say hello to my little friend.
Better get busy living, or get busy dying.
Mrs. Robinson, you're trying to seduce me, aren't you?
I love the smell of napalm in the morning.
Why so serious?
All right, Mr. DeMille, I'm ready for my close-up.
ET phone home.
You mustn't be afraid to dream a little bigger darling.
You're gonna need a bigger boat.
I am serious, and don't call me Shirley.
Elementary, my dear Watson.
You can't handle the truth.
In Switzerland they had brotherly love - they had 500 years of democracy and peace, and what did that produce? The cuckoo clock.
I'll have what she's having.
Just keep swimming.
They're here.
Forget it Jake, it's Chinatown.
Toga! Toga!
Attica! Attica!
Say 'what' again!
Freedom!
Nobody's perfect.
This is Sparta!
Today I consider myself the luckiest man on the face of the Earth.
They call me Mr. Tibbs.
Houston, we have a problem.
Are you suggesting coconuts migrate?
Cinderella story. Outta nowhere. A former greenskeeper, now, about to become the Masters champion. It looks like a mirac...It's in theIt's in the hole! It's in the hole!
If you build it, he will come.
The greatest trick the Devil ever pulled was convincing the world he didn't exist.
Life moves pretty fast. If you don't stop and look around once in a while, you could miss it.
Oh, no, it wasn't the airplanes. It was Beauty killed the Beast.
We're on a mission from God.
I have had it with these fuckin' snakes on this fuckin' plane.
You make me want to be a better man.
What we've got here is a failure to communicate.
Badges? We ain't got no badges. We don't need no badges. I don't have to show you any stinking badges.
Have you ever seen a grown man naked?
Love means never having to say you're sorry.
I shot an elephant in my pajamas. How he got in my pajamas I’ll never know.
I want you to hit me as hard as you can.
Greed, for the lack of a better word, is good.
Teacher says, 'Every time a bell rings an angel gets its wings.'
Yo, Adrian!
You probably heard we ain't in the prisoner-takin' business; we in the killin' Nazi business. And cousin, business is a-boomin'.
They pee'd on your fuckin' rug.
Well, my name is Jim, but most people call me... Jim.
Because making something disappear isn’t enough, you have to bring it back.
Was it over when the Germans bombed Pearl Harbor.
Well ain’t this place a geographical oddity, two weeks from everywhere.
I'm a goddamn marvel of modern science.
You know how to whistle, don't you Steve? You just put your lips together and blow.
It does not do to dwell on dreams, Harry, and forget to live.
I'm in a glass case of emotion.";

	// Here we split it into lines
	$all_quotes = explode( "\n", $all_quotes );

	// And then randomly choose a line
	return wptexturize( $all_quotes[ mt_rand( 0, count( $all_quotes ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_quotes() {
	$picked_quote = hello_movie_quotes();
	echo "<p id='movie-quotes'>$picked_quote</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_quotes' );

// We need some CSS to position the paragraph
function quotes_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>

	#dolly {
		display: none !important;
	}

	#movie-quotes {
		float: $x;
		padding-$x: 5px;
		padding-top: 5px;
		margin: 0;
		font-size: 11px;
	}

	</style>
	";
}

add_action( 'admin_head', 'quotes_css' );

?>
