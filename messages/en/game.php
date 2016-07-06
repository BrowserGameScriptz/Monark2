<?php
/**
 * Message translations.
 *
 * This file is automatically generated by 'yii message' command.
 * It contains the localizable messages extracted from source code.
 * You may modify this file by translating the extracted messages.
 *
 * Each array element represents the translation (value) of a message (key).
 * If the value is empty, the message is considered as not translated.
 * Messages that no longer need translation will have their translations
 * enclosed between a pair of '@@' marks.
 *
 * Message string can be used with plural forms format. Check i18n section
 * of the guide for details.
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
return [
	/* Title */
	'Title_Create' => 'Create your game',
    'Title_Loby' => 'Game lobbies list',
    'Title_Join' => 'Join a game',
    'Title_Loading' => 'Loading...',

	/* Tab */
	'Tab_Game_Name' => 'Game Name',
	'Tab_Owner_Name' => 'Owner Name',
	'Tab_Max_Player' => "Players",
	'Tab_Create_Time' => "Create time",
	'Tab_Rejoin' => "Join the game",
		
    /* Text*/
    'Creation_Rules' => 'Please complete the form to create your game :',
    'Join_Rules' => 'Please enter the password of the game :',
    'Chat_General' => 'General chat',
	'Text_Second_{nb}' => '{nb} sec ago',
	'Text_Min_{nb}' => '{nb} min ago',
	'Text_Hour_{nb}' => '{nb} h ago',
	'Text_Yesterday' => 'Yesterday',
	'Text_Week' => 'This week',
	'Text_Date' => 'm/d/Y',
	'Text_Load_Title' => 'Steps',
	'Text_Load_Step_0' => 'Assigning ressources',
	'Text_Load_Step_1' => 'Assigning territories',
	'Text_Load_Step_2' => 'Players management',
	'Text_Load_Step_3' => 'Turns management',
	'Text_Load_Step_4' => 'Finalizing',
    
	/* Errors & success */	
	'Error_Name_Already_Use' => 'Game name already used',
    'Error_Password_Incorrect' => 'A password is required : incorrect password.',
    'Error_User_Already_In_Game' => 'You are already in an other game !',
    'Error_Game_Full' => 'The game is full.',
    'Error_Game_Not_Exist' => "The game not exist anymore.",
    'Error_Start_Multiple_Color' => "The game can't start : Several players chose the same color.",
    'Error_Start_Not_Ready' => "The game can't start : Several players are not ready.",
    'Error_Start_Stop' => "The game can't start.",
	'Error_Max_Player_Nb' => "The maximum number of players is 10.",
    'Success_User_Left_Game' => 'You have left the game.',
    'Success_User_Enter_Game_{params}' => 'You have join the game : {params}.',
	'Success_Game_Created' => 'Game created.',
	'Success_Game_Join' => 'Game joined.',
	'Notice_Game_Quit' => 'Game exited.',
		
    /* Buttons */ 
    'Button_Send' => 'Send',
    'Button_Game_Create' => 'Create a game',
    'Button_Game_Enter' => 'Join the game',
    'Button_Game_Return' => 'Return to game',
    'Button_Game_Spec' => 'Spectate the game',
    'Button_Game_Ban' => 'You were ban of the game',
    'Button_Game_End' => 'End Game',

    /* Form */
    'Form_Create_Name' => 'Name',
    'Form_Create_Time' => 'Creation',
    'Form_Create_Pwd' => 'Password',
    'Form_Create_Max_Player' => 'Number of players',
    'Form_Create_Mod_Id' => 'Game mode',
    'Form_Create_Difficulty_Id' => 'Difficulty',
    'Form_Create_Map_Id' => 'Map',
    'Form_Create_Owner' => 'Host of the game',
    'Form_Join_Pwd' => 'Password',
];
?>