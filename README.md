# 🧩 BrValidator

Uma biblioteca **PHP** simples e extensível para **validação, formatação e manipulação de documentos brasileiros**, como **CNPJ**, **CPF** e **CNS (Cartão Nacional de Saúde)**.  


---

## 🚀 Instalação

```bash
composer require kayobruno/br-validator
```

### 🧠 Principais Features

- ✅ Validação de documentos brasileiros (CNPJ, CPF, CNS)
- ✅ Validação de CNPJ com suporte para o formato alfanumérico
- ✅ Formatação com máscara (ex: 11.222.333/0001-81)
- ✅ Ofuscação dos dados sensíveis
- ✅ Value Objects imutáveis


### 📘 Exemplos de Uso

```
use BrValidator\BrValidator;
use BrValidator\Enums\DocumentType;
use BrValidator\ValueObjects\CNPJValueObject;

$isValid = BrValidator::isValid('251922606580000', DocumentType::CNS); // true
$isValid = BrValidator::isValid('123.456.789-09', DocumentType::CPF); // true
$isValid = BrValidator::isValid('11.222.333/0001-81', DocumentType::CNPJ); // true
$isValid = BrValidator::isValid('CT.5O5.QVR/0001-30', DocumentType::CNPJ); // true

// Value Objects

// Se o número informado for inválido uma exception do tipo InvalidArgumentException será lançada.
$cnpj = new CNPJValueObject('11222333000181');

echo $cnpj->getUnmaskedValue(); // 11222333000181
echo $cnpj->getMaskedValue();   // 11.222.333/0001-81
echo $cnpj->getObfuscatedValue(); // ***.***.***/0001-81

```




> “Simplicidade é o último grau de sofisticação.” — Leonardo da Vinci