<?php

//setting default password length to 4
$password_length = 4;

// checks if user inputs the no. of words and sets the value to a variable $password_length
if (($_POST['number_of_words']))
{
	// taking input of password length from user and storing it
	$password_length = $_POST['number_of_words'];
}
else
{
	$password_length = 4;
}

// checks if the user checks the insert number box and if yes, sets $insert_number to True
if (isset($_POST['insert_number']))
{
	$insert_number = True;
}
else
{
	// if user doesn't check the box, sets $insert_number to False
	$insert_number = False;  
}

// checks if the user checks the insert symbol box and if yes, sets $insert_symbol to True
if (isset($_POST['insert_symbol'])) 
{
	$insert_symbol = True;
} 
else 
{
	// if user doesn't check the box, sets $insert_number to False
	$insert_symbol = False;
}

/* Setting these variables as False.
   They may get converted to True depending on user input */

$camel_case = False;
$upper_case = False;

// checks what input has user given for Upper Case letters?
if (isset($_POST['upper_case'])) 
{
	// If user chooses CamelCase, sets $camel_case to True
	if ($_POST['upper_case'] == 'camel_case')
	{
		$camel_case = True;
	}
	// If user chooses UPPERCASE, sets $upper_case to True
	elseif ($_POST['upper_case'] == 'all') 
	{
		$upper_case = True;
	}
}

/** if user chooses lower case, sets both of them to false/
*** We do not need a separate variable for lower_case, as in that case, 
*** we do not need to do anything because the words are already lower case  */
else
{
	$camel_case = False;
	$upper_case = False;
}


/** Takes a file called words.txt which has
*** 5000 most common english words.
*** We read that file and store each individual word
*** into a String $filecontent and then use that
*** String to make an array called $words which 
*** has all the individual words
**/

$filecontent = file_get_contents('words.txt');
$words = preg_split('/[\s]+/', $filecontent, -1, PREG_SPLIT_NO_EMPTY);

// Calulates and stores the length of the array $words
$array_length = count($words);


/* 
choosing the random numbers from 0 to length of array
then storing these random numbers in an array.
These number won't be repeated.
Then using these numbers to generate our password string 
*/

$random_nums = [];  // the array which will store the random numbers

for ($i = 0; $i < $password_length; $i++)
{	
	$random_nums[$i] = rand(0, $array_length - 1);
	
	// checks that no random value is repeated
	for ($j = 0; $j < $i; $j++)
	{
		if ($random_nums[$i] == $random_nums[$j])
		{
			$random_nums[$i] = rand(0, $array_length - 1);
			$j = 0;
		}
	}
}


/* Making an array of words to be used in the password
** We use the array $random_nums to make this array
*/

// The array which will store the words to be used in the password
$password_word_list = []; 

for ($i=0; $i < $password_length ; $i++) 
{ 
	array_push($password_word_list, $words[$random_nums[$i]]);
}


/* Checking user input and accordingly making the words
** UPPERCASE or CamelCase 
** No need to have a special loop for lower case, 
** as currently the words are lower case 
*/

if ($camel_case)
{
	// making words of the password CamelCase
	for ($i=0; $i < $password_length ; $i++) 
	{ 
		$password_word_list[$i] = ucfirst($password_word_list[$i]);
	}
}
elseif ($upper_case)
{
	// making words of the password UPPERCASE
	for ($i=0; $i < $password_length ; $i++) 
	{
		$password_word_list[$i] = strtoupper($password_word_list[$i]);
	}
}


/*   
Creating a separator based on user input 
and then using it to create the password
*/


if (isset($_POST['separator'])) 
{
	if ($_POST['separator'] == 'not_separated')
	{
		$separator = '';
	}	

	elseif ($_POST['separator'] == 'spaces') 
	{
		$separator = ' ';
	}	
	else
	{	
		$separator = '-';
	}
}
// Default Value
else 
{
	$separator = '-';
}



// sets password using the first random number and words dictionary
$password = $password_word_list[0];
// print_r($password_word_list);

/* Loops over the final password word list ($password_word_list)
** to create the final password
** Also, adding the separator inbetween
*/
for ($i=1; $i < $password_length; $i++) 
{ 
	$password = $password.$separator.$password_word_list[$i];
}


/* If user has asked to insert a number,
** we will generate a random number 
** and append it at the end of the password
*/
if ($insert_number)
{
	$password .= (rand(0,9));
}

// Creating an array of symbols to be used below
$symbols = ['!', '#', '$', '%', '&', '*', '/', '.'];  

/* If user has asked to insert a symbol,
** we will generator a random symbol from an array of symbols 
** and append it at the end of the password
*/

if ($insert_symbol)
{
	$password .= $symbols[(rand(0,(count($symbols) - 1)))];
}
