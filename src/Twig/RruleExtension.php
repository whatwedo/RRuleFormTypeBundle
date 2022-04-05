<?php

declare(strict_types=1);

namespace whatwedo\RruleFormBundle\Twig;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RruleExtension extends AbstractExtension
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('whatwedo_rrule', fn (string $rrule) => $this->formatRrule($rrule), [
                'is_safe' => ['html'],
                'is_safe_callback' => true,
            ]),
        ];
    }

    public function formatRrule(string $rruleString)
    {
        $rrule = [];
        $rruleParts = explode(';', $rruleString);

        foreach ($rruleParts as $rrulePart) {
            $itemParts = explode('=', $rrulePart);
            $rrule[$itemParts[0]] = $itemParts[1];
        }

        $render = $this->twig->render(
            '@whatwedoRruleForm/twig/rrule_extension.html.twig',
            [
                'rrule' => $rrule,
            ]
        );

        return $render;
    }
}
