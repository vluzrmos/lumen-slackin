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

    'accepted' => 'La valeur :attribute doit être accepté.',
    'active_url' => 'La valeur :attribute n\'est pas une URL valide.',
    'after' => 'La valeur :attribute doit être postérieure à :date.',
    'alpha' => 'La valeur :attribute ne peut contenir que des lettres.',
    'alpha_dash' => 'La valeur :attribute ne peut contenir que des lettres, chiffres, et tirets.',
    'alpha_num' => 'La valeur :attribute ne peut contenir que des lettres et chiffres.',
    'array' => 'La valeur :attribute doit être un tableau.',
    'before' => 'La valeur :attribute doit être une date antérieure à :date.',
    'between' => [
        'numeric' => 'La valeur :attribute doit être comprise entre :min et :max.',
        'file' => 'La valeur :attribute doit être comprise entre :min et :max kilobytes.',
        'string' => 'La valeur :attribute doit comprendre de :min à :max caractères.',
        'array' => 'La valeur :attribute doit comprendre de :min à :max articles.',
    ],
    'boolean' => 'La valeur :attribute doit être vrai ou faux.',
    'confirmed' => 'La valeur de confirmation de :attribute ne correspond pas.',
    'date' => 'La valeur :attribute n\'est pas une date valide.',
    'date_format' => 'La valeur :attribute ne respecte pas le format :format.',
    'different' => 'Les valeurs :attribute et :other doivent être differentes.',
    'digits' => 'La valeur :attribute doit comporter :digits chiffres.',
    'digits_between' => 'La valeur :attribute doit comporter entre :min et :max chiffres.',
    'email' => 'La valeur :attribute doit être une adresse email valide.',
    'filled' => 'Le champ :attribute est obligatoire.',
    'exists' => 'La valeur :attribute sélectionnée est invalide.',
    'image' => ':attribute doit être une image.',
    'in' => 'La selection :attribute est invalide.',
    'integer' => ':attribute doit être un chiffre.',
    'ip' => ':attribute doit être une adresse IP valide.',
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'La valeur de :attribute est requise.',
    'required_if' => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_with' => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all' => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_without' => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsqu\'aucunes des valeurs :values ne sont présentes.',
    'same' => ':attribute et :other doivent être identiques.',
    'size' => [
        'numeric' => 'La valeur :attribute doit être :size.',
        'file' => 'La valeur :attribute doit faire :size kilobytes.',
        'string' => 'La valeur :attribute doit comporter :size caractères.',
        'array' => 'La valeur :attribute doit contenir :size articles.',
    ],
    'unique' => 'La valeur :attribute a déjà été utilisée.',
    'url' => 'La valeur :attribute n\'a pas un format valide.',
    'timezone' => 'La valeur :attribute doit être une zone valide.',
    'wrong' => 'Un problème est survenu.',
    'min_words' => 'Entrez au moins :words mots.',

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
            'min_words' => 'Entrez votre prénom et nom',
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
        'username' => 'nom',
        'email' => 'Adresse email',
    ],

];
