<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Das Feld :attribute musss akzeptiert werden.',
    'active_url' => 'Das Feld :attribute ist keine gültige URL.',
    'after' => 'Das Feld :attribute muss ein Datum nach :date sein.',
    'alpha' => 'Das Feld :attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => 'Das Feld :attribute darf nur Buchstaben, Zahlen und Bindestriche enthalten.',
    'alpha_num' => 'Das Feld :attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => 'Das Feld :attribute muss ein Array sein.',
    'before' => 'Das Feld :attribute muss ein Datum vor :date sein.',
    'between' => [
        'numeric' => 'Der Wert von :attribute muss zwischen :min und :max liegen.',
        'file' => 'Die Datei :attribute muss zwischen :min und :max Kilobyte groß sein.',
        'string' => 'Die Länge des Feldes :attribute muss zwischen :min und :max Zeichen liegen.',
        'array' => 'Die Länge des Array :attribute muss zwischen :min und :max liegen.',
    ],
    'boolean' => 'Das Feld :attribute muss "wahr" oder "falsch" sein.',
    'confirmed' => 'Die :attribute Bestätigung stimmt nicht überein.',
    'date' => 'Das Feld :attribute ist kein gültiges Datum.',
    'date_format' => 'Das Feld :attribute entspricht nicht dem Format :format.',
    'different' => 'Die Felder :attribute und :other müssen sich unterscheiden.',
    'digits' => 'Das Feld :attribute muss :digits Zeichen haben.',
    'digits_between' => 'Das Feld muss eine Länge :attribute zwischen :min und :max Zeichen haben.',
    'email' => 'Das Feld :attribute muss eine gültige E-Mail-Adresse sein.',
    'filled' => 'Das Feld :attribute wird benötigt.',
    'exists' => 'Das ausgewählte Feld :attribute ist ungültig.',
    'image' => 'Das Feld :attribute muss ein Bild sein.',
    'in' => 'Das ausgewählte Feld :attribute ist ungültig.',
    'integer' => 'Das Feld :attribute muss eine ganze Zahl sein.',
    'ip' => 'Das Feld :attribute muss eine gültige IP-Adresse sein.',
    'max' => [
        'numeric' => 'Der Wert von :attribute darf nicht größer als :max sein.',
        'file' => 'Die Datei :attribute darf nicht größer als :max Kilobyte sein.',
        'string' => 'Die Länge des Feldes :attribute darf nicht größer als :max Zeichen sein.',
        'array' => 'Die Länge des Arrays :attribute darf nicht größer als :max sein.',
    ],
    'mimes' => 'Das Feld :attribute muss eine Datei vom Typ :values sein.',
    'min' => [
        'numeric' => 'Der Wert von :attribute muss mindestens :min sein.',
        'file' => 'Die Datei :attribute muss mindestens :min Kilobyte groß sein.',
        'string' => 'Die Länge des Feldes :attribute muss mindestens :min Zeichen lang sein.',
        'array' => 'Die Länge des Array :attribute muss mindestens :min betragen.',
    ],
    'not_in' => 'Das ausgewählte Feld :attribute ist ungültig.',
    'numeric' => 'Das Feld :attribute muss eine Zahl sein.',
    'regex' => 'Das Format des Felds :attribute ist ungültig.',
    'required' => 'Das Feld :attribute muss angegeben werden.',
    'required_if' => 'Das Feld :attribute muss angegeben werden, wenn :other :value ist.',
    'required_with' => 'Das Feld :attribute muss angegeben werden :values angegeben ist.',
    'required_with_all' => 'Das Feld :attribute muss angegeben werden, wenn :values angegeben ist.',
    'required_without' => 'Das Feld :attribute muss angegeben werden :values nicht angegeben ist.',
    'required_without_all' => 'Das Feld :attribute muss angegeben werden, wenn keines von :values angegeben sind.',
    'same' => 'Die Felder :attribute und :other müssen übereinstimmen.',
    'size' => [
        'numeric' => 'Das Feld :attribute muss :size groß sein.',
        'file' => 'Die Datei :attribute muss :size Kilobyte groß sein.',
        'string' => 'Die Länge des Feldes :attribute muss :size Zeichen lang sein.',
        'array' => 'Die Länge des Array :attribute muss :size betragen.',
    ],
    'unique' => 'Der Wert für das Feld :attribute wurde bereits verwendet.',
    'url' => 'Das Format des Felder :attribute ist ungültig.',
    'timezone' => 'Das Feld :attribute muss eine gültige Zeitzone sein.',
    'wrong' => 'Etwas ist schief gelaufen.',
    'min_words' => 'Gib mindestens :words Wort ein.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'username' => [
            'min_words' => 'Gib bitte deinen Vor- und Nachnamen ein',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'username' => 'Benutzername',
        'email' => 'E-Mail-Adresse',
    ],

];
