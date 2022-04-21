# RRule Form

Adds a form type wich creates a rrule-string


use

https://github.com/rlanvin/php-rrule

or

https://github.com/simshaun/recurr


to parse your rrule string



## Installation

add ´"whatwedo/rruleform-bundle": "dev-master"´ to ´composer.json´

```json
  "require-dev": {
      "whatwedo/rruleform-bundle": "dev-master"
  },
  "repositories": [
        {
            "type": "vcs",
            "url": "git@dev.whatwedo.ch:maurizio/rruleFormType.git"
        }
    ]
```

run `composer install`

```
composer install
```

add `FormBundle` to `bundles.json`

```phpt
    whatwedo\RruleFormBundle\whatwedoRruleFormBundle::class => ['all' => true],
```

add `"@whatwedo/rrule"` to `packages.json`

```json
    "devDependencies": {    
        "@whatwedo/rrule": "file:vendor/whatwedo/rruleform-bundle/Resources/assets"
    }
```

add `theme` to `twig.yqml`

```yaml
twig:
  form_themes:
    - '@whatwedoRruleForm/form/rrule.html.twig'
```

add `"@whatwedo/rrule"` to `packages.json`

```json
    "devDependencies": {    
        "@whatwedo/rrule": "file:vendor/whatwedo/rruleform-bundle/Resources/assets"
    }
```

refresh your JavaScript dependencies

```shell script
    yarn install --force
    npm install --force
```
    

add the Rrule to yout stimulus `assets/controllers.json`

```json
{
    "controllers": {
        "@whatwedo/rrule": {
            "rrule": {
                "enabled": true,
                "fetch": "eager"
            }
        }
    },
    "entrypoints": []
}

```

add the new form theme in your twig configuration `config/packages/twig.yaml`

  
```yaml
      form_themes:
        - '@whatwedoRruleForm/form/rrule.html.twig'
```

add the RRule Form type to your Form

```php
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder->add('rrule',
        RRuleType::class,
        [
            'label' => 'label.event.rrule',
        ]
    );
}
```

