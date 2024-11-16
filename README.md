# QWERTYCrypt

QWERTYCrypt é uma classe PHP para codificação e decodificação de mensagens baseada em um dicionário customizado de caracteres. Este projeto foi projetado para criar um método simples de criptografia leve e reversível.

## Funcionalidades

- **Codificação (`encode`)**: Converte uma sequência de caracteres em uma sequência codificada baseada no dicionário.
- **Decodificação (`decode`)**: Reverte a sequência codificada para a mensagem original.

## Como funciona?

### Codificação
1. Cada caractere da mensagem original é mapeado para um conjunto definido no dicionário (`$dict`).
2. O índice do caractere no conjunto é registrado com uma "chave" correspondente.
3. O resultado é uma string que combina a chave e o índice de cada caractere.

### Decodificação
1. Cada chave e índice da mensagem codificada é usado para localizar o caractere original no dicionário.
2. O resultado é a mensagem original reconstruída.

## Estrutura do dicionário (`$dict`)

O dicionário mapeia caracteres para diferentes linhas, baseando-se nos grupos do teclado QWERTY:

```php
private static $dict = [
  'q' => "qwertyuiopêûîôéúíóèùìòõ´[",
  'a' => "asdfghjklçâáàã~]",
  'z' => "zxcvbnm,.;/",
  '1' => "1234567890'\"!@#$%¨&*()-_=+",
  'Q' => "QWERTYUIOPÊÛÎÔÉÚÍÓÈÙÌÒÕ`{",
  'A' => "ASDFGHJKLÇÂÁÀÃ^}",
  'Z' => "ZXCVBNM<>:?\|",
];
```

### Como usar

## Codificação:
```php
require "Crypto.php";

$text = "Olá Mundo!";
$encoded = QWERTYCrypt::encode($text);

echo "Encode: $encoded\n";
```

## Decodificação:
```php
require "Crypto.php";

$text = "Q8 a8 q10 a14  Z6 q6 z5 a2 q8 112";
$decoded = QWERTYCrypt::decode($text);

echo "Decode: $decoded\n";
```

### Requisitos
 - PHP 7.4 ou superior.

### Considerações
1. Caractere não mapeado: Caso um caractere não esteja no dicionário, ele será substituído por ? durante a decodificação.
2. Espaços: Espaços são preservados na codificação e decodificação.