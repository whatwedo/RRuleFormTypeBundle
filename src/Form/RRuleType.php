<?php

declare(strict_types=1);

namespace whatwedo\RruleFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class RRuleType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add(
                'freq',
                ChoiceType::class,
                [
                    'label' => 'rrule.frequency.label',
                    'choices' => [
                        'rrule.frequency.option.none' => 'none',
                        'rrule.frequency.option.daily' => 'daily',
                        'rrule.frequency.option.weekly' => 'weekly',
                        'rrule.frequency.option.monthly' => 'monthly',
                        'rrule.frequency.option.yearly' => 'yearly',
                    ],
                    'expanded' => true,
                    'required' => false,
                    'placeholder' => false,
                    'empty_data' => 'none',
                    'choice_attr' => fn ($a) => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'freq',
                        'data-action' => 'whatwedo--rruleform-bundle--rrule#selectFreq',
                    ],
                ]
            )
            ->add(
                'interval',
                IntegerType::class,
                [
                    'label' => 'rrule.interval.label',
                    'attr' => [
                        'min' => 1,
                        'max' => 31,
                    ],
                    //'html5' => true,
                    'required' => true,
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'interval',
                    ],
                ]
            )
            ->add(
                'weekday',
                ChoiceType::class,
                [
                    'label' => 'rrule.weekday.label',
                    'choices' => [
                        'rrule.weekday.option.mo' => 'mo',
                        'rrule.weekday.option.tu' => 'tu',
                        'rrule.weekday.option.we' => 'we',
                        'rrule.weekday.option.th' => 'th',
                        'rrule.weekday.option.fr' => 'fr',
                        'rrule.weekday.option.sa' => 'sa',
                        'rrule.weekday.option.so' => 'so',
                    ],
                    'expanded' => true,
                    'multiple' => true,
                    'required' => true,
                    'choice_attr' => fn ($a) => [
                        'data-action' => 'whatwedo--rruleform-bundle--rrule#selectWeekday',
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'weekday',
                    ],
                ]
            )
            ->add(
                'monthlyRule',
                ChoiceType::class,
                [
                    'label' => 'monthdayRule',
                    'choices' => [
                        'rrurle.monthdayRule.option.byMonthDay' => 'byMonthDay',
                        'rrurle.monthdayRule.option.byDay' => 'byDay',
                    ],
                    'expanded' => true,
                    'required' => false,
                    'choice_attr' => fn () => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'monthlyRule',
                        'data-action' => 'whatwedo--rruleform-bundle--rrule#selectMonthlyRule',
                    ],
                ]
            )
            ->add(
                'monthlyMonthDay',
                ChoiceType::class,
                [
                    'label' => 'monthDay',
                    'choices' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8',
                        '9' => '9',
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15',
                        '16' => '16',
                        '17' => '17',
                        '18' => '18',
                        '19' => '19',
                        '20' => '20',
                        '21' => '21',
                        '22' => '22',
                        '23' => '23',
                        '24' => '24',
                        '25' => '25',
                        '26' => '26',
                        '27' => '27',
                        '28' => '28',
                        '29' => '29',
                        '30' => '30',
                        '31' => '31',
                    ],
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false,
                    'choice_attr' => fn () => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'monthlyMonthDay',
                        'data-action' => 'whatwedo--rruleform-bundle--rrule#monthlyMonthDaySelect',
                    ],
                ]
            )
            ->add(
                'monthlyByDayPos',
                ChoiceType::class,
                [
                    'label' => 'byDayPos',
                    'choices' => [
                        'rrule.byDayPos.option.first' => 1,
                        'rrule.byDayPos.option.second' => 2,
                        'rrule.byDayPos.option.third' => 3,
                        'rrule.byDayPos.option.fourth' => 4,
                        'rrule.byDayPos.option.last' => -1,
                    ],
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'monthlyByDayPos',
                        'style' => 'display: inline; width: auto',
                    ],
                    'required' => false,
                ]
            )
            ->add(
                'monthlyByDayWeekday',
                ChoiceType::class,
                [
                    'label' => 'byDayWeekday',
                    'choices' => [
                        'rrule.byDayWeekday.option.sunday' => 'SU',
                        'rrule.byDayWeekday.option.monday' => 'MO',
                        'rrule.byDayWeekday.option.tuesday' => 'TU',
                        'rrule.byDayWeekday.option.wednesday' => 'WE',
                        'rrule.byDayWeekday.option.thursday' => 'TH',
                        'rrule.byDayWeekday.option.friday' => 'FR',
                        'rrule.byDayWeekday.option.saturday' => 'SA',
                        'rrule.byDayWeekday.option.day' => 'SU,MO,TU,WE,TH,FR,SA',
                        'rrule.byDayWeekday.option.weekday' => 'MO,TU,WE,TH,FR',
                        'rrule.byDayWeekday.option.weekendDay' => 'SU,SA',
                    ],
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'monthlyByDayWeekday',
                        'style' => 'display: inline; width: auto',
                    ],
                    'required' => false,
                ]
            )
            ->add(
                'yearlyRule',
                ChoiceType::class,
                [
                    'label' => 'rrule.yearlyRule.label',
                    'choices' => [
                        'rrule.yearlyRule.option.oneMonth' => 'oneMonth',
                        'rrule.yearlyRule.option.byMonth' => 'byMonth',
                        'rrule.yearlyRule.option.byDay' => 'byDay',
                    ],
                    'required' => false,
                    'expanded' => true,
                    'choice_attr' => fn () => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'yearlyRule',
                        'data-action' => 'whatwedo--rruleform-bundle--rrule#selectYearlyRule',
                    ],
                ]
            )
            ->add(
                'yearlyOneMonthByMonth',
                ChoiceType::class,
                [
                    'label' => 'byMonth',
                    'choices' => [
                        'rrule.byMonth.option.january' => '1',
                        'rrule.byMonth.option.february' => '2',
                        'rrule.byMonth.option.march' => '3',
                        'rrule.byMonth.option.april' => '4',
                        'rrule.byMonth.option.may' => '5',
                        'rrule.byMonth.option.june' => '6',
                        'rrule.byMonth.option.july' => '7',
                        'rrule.byMonth.option.august' => '8',
                        'rrule.byMonth.option.september' => '9',
                        'rrule.byMonth.option.october' => '10',
                        'rrule.byMonth.option.november' => '11',
                        'rrule.byMonth.option.december' => '12',
                    ],
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'yearlyOneMonthByMonth',
                        'style' => 'display: inline; width: auto',
                    ],
                    'required' => false,
                ]
            )
            ->add(
                'yearlyOneMonthDay',
                ChoiceType::class,
                [
                    'label' => 'monthDay',
                    'choices' => [
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6',
                        '7' => '7',
                        '8' => '8',
                        '9' => '9',
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15',
                        '16' => '16',
                        '17' => '17',
                        '18' => '18',
                        '19' => '19',
                        '20' => '20',
                        '21' => '21',
                        '22' => '22',
                        '23' => '23',
                        '24' => '24',
                        '25' => '25',
                        '26' => '26',
                        '27' => '27',
                        '28' => '28',
                        '29' => '29',
                        '30' => '30',
                        '31' => '31',
                    ],
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false,
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'yearlyOneMonthDay',
                        'style' => 'display: inline; width: auto',
                    ],
                ]
            )
            ->add(
                'yearlyByMonthByMonth',
                ChoiceType::class,
                [
                    'label' => 'byMonth',
                    'choices' => [
                        'rrule.byMonth.option.january' => '1',
                        'rrule.byMonth.option.february' => '2',
                        'rrule.byMonth.option.march' => '3',
                        'rrule.byMonth.option.april' => '4',
                        'rrule.byMonth.option.may' => '5',
                        'rrule.byMonth.option.june' => '6',
                        'rrule.byMonth.option.july' => '7',
                        'rrule.byMonth.option.august' => '8',
                        'rrule.byMonth.option.september' => '9',
                        'rrule.byMonth.option.october' => '10',
                        'rrule.byMonth.option.november' => '11',
                        'rrule.byMonth.option.december' => '12',
                    ],
                    'choice_attr' => fn ($a) => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'yearlyByMonthByMonth',
                        'data-action' => 'whatwedo--rruleform-bundle--rrule#selectYearlyByMonthByMonth',
                    ],
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false,
                ]
            )
            ->add(
                'yearlyByDayPos',
                ChoiceType::class,
                [
                    'label' => 'byDayPos',
                    'choices' => [
                        'rrule.byDayPos.option.first' => 1,
                        'rrule.byDayPos.option.second' => 2,
                        'rrule.byDayPos.option.third' => 3,
                        'rrule.byDayPos.option.fourth' => 4,
                        'rrule.byDayPos.option.last' => -1,
                    ],
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'yearlyByDayPos',
                        'style' => 'display: inline; width: auto',
                    ],
                    'required' => false,
                ]
            )
            ->add(
                'yearlyByDayWeekday',
                ChoiceType::class,
                [
                    'label' => 'byDayWeekday',
                    'choices' => [
                        'rrule.byDayWeekday.option.sunday' => 'SU',
                        'rrule.byDayWeekday.option.monday' => 'MO',
                        'rrule.byDayWeekday.option.tuesday' => 'TU',
                        'rrule.byDayWeekday.option.wednesday' => 'WE',
                        'rrule.byDayWeekday.option.thursday' => 'TH',
                        'rrule.byDayWeekday.option.friday' => 'FR',
                        'rrule.byDayWeekday.option.saturday' => 'SA',
                        'rrule.byDayWeekday.option.day' => 'SU,MO,TU,WE,TH,FR,SA',
                        'rrule.byDayWeekday.option.weekday' => 'MO,TU,WE,TH,FR',
                        'rrule.byDayWeekday.option.weekendDay' => 'SU,SA',
                    ],
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'yearlyByDayWeekday',
                        'style' => 'display: inline; width: auto',
                    ],
                    'required' => false,
                ]
            )
            ->add(
                'yearlyByDayByMonth',
                ChoiceType::class,
                [
                    'label' => 'byMonth',
                    'choices' => [
                        'rrule.byMonth.option.january' => '1',
                        'rrule.byMonth.option.february' => '2',
                        'rrule.byMonth.option.march' => '3',
                        'rrule.byMonth.option.april' => '4',
                        'rrule.byMonth.option.may' => '5',
                        'rrule.byMonth.option.june' => '6',
                        'rrule.byMonth.option.july' => '7',
                        'rrule.byMonth.option.august' => '8',
                        'rrule.byMonth.option.september' => '9',
                        'rrule.byMonth.option.october' => '10',
                        'rrule.byMonth.option.november' => '11',
                        'rrule.byMonth.option.december' => '12',
                    ],
                    'multiple' => false,
                    'required' => false,
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'yearlyByDayByMonth',
                        'style' => 'display: inline; width: auto',
                    ],
                ]
            )
            ->add(
                'untilRule',
                ChoiceType::class,
                [
                    'label' => 'untilRule',
                    'choices' => [
                        'rrule.untilRule.option.count' => 'count',
                        'rrule.untilRule.option.date' => 'date',
                    ],
                    'expanded' => true,
                    'required' => true,
                    'choice_attr' => fn () => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'untilRule',
                        'data-action' => 'whatwedo--rruleform-bundle--rrule#selectUntilRule',
                    ],
                ]
            )
            ->add(
                'untilCount',
                NumberType::class,
                [
                    'label' => 'untilCount',
                    'required' => false,
                    'attr' => [
                        'min' => 1,
                        'may' => 31,
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'untilCount',
                    ],
                ]
            )
            ->add(
                'untilDate',
                DateType::class,
                [
                    'label' => 'untilDate',
                    'required' => false,
                    'widget' => 'single_text',
                    'attr' => [
                        'data-whatwedo--rruleform-bundle--rrule-target' => 'untilDate',
                    ],
                ]
            )
            ->setDataMapper($this);
    }

    public function getBlockPrefix()
    {
        return 'rrule';
    }

    /**
     * @param string                       $viewData
     * @param FormInterface[]|\Traversable $forms
     */
    public function mapDataToForms($viewData, $forms)
    {
        // there is no data yet, so nothing to prepopulate
        if ($viewData === null) {
            return;
        }

        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);
        $forms['freq']->setData('none');
        $forms['interval']->setData(1);

        if ($viewData !== '') {
            $rrule = $this->extractRule($viewData);

            $forms['freq']->setData(
                strtolower($rrule['FREQ'])
            );

            $forms['interval']->setData(
                strtolower($rrule['INTERVAL'])
            );

            if ($rrule['FREQ'] === 'WEEKLY') {
                $forms['weekday']->setData(
                    explode(',', strtolower($rrule['BYDAY']))
                );
            }
            if ($rrule['FREQ'] === 'MONTHLY') {
                if (isset($rrule['BYMONTHDAY'])) {
                    $forms['monthlyRule']->setData('byMonthDay');
                    $forms['monthlyMonthDay']->setData(
                        explode(',', strtolower($rrule['BYMONTHDAY']))
                    );
                } elseif (isset($rrule['BYDAY']) && isset($rrule['BYSETPOS'])) {
                    $forms['monthlyRule']->setData('byDay');
                    $forms['monthlyByDayWeekday']->setData(
                        strtolower($rrule['BYDAY'])
                    );
                    $forms['monthlyByDayPos']->setData(
                        strtolower($rrule['BYSETPOS'])
                    );
                }
            }
            if ($rrule['FREQ'] === 'YEARLY') {
                if (isset($rrule['BYDAY']) && isset($rrule['BYSETPOS']) && isset($rrule['BYMONTH'])) {
                    $forms['yearlyRule']->setData('byDay');
                    $forms['yearlyByDayWeekday']->setData(
                        strtolower($rrule['BYDAY'])
                    );
                    $forms['yearlyByDayPos']->setData(
                        strtolower($rrule['BYSETPOS'])
                    );
                    $forms['yearlyByDayByMonth']->setData(
                        strtolower($rrule['BYMONTH'])
                    );
                } elseif (isset($rrule['BYMONTHDAY']) && isset($rrule['BYMONTH'])) {
                    $forms['yearlyRule']->setData('oneMonth');
                    $forms['yearlyOneMonthDay']->setData(
                        strtolower($rrule['BYMONTHDAY'])
                    );
                    $forms['yearlyOneMonthByMonth']->setData(
                        strtolower($rrule['BYMONTH'])
                    );
                } elseif (isset($rrule['BYMONTH'])) {
                    $forms['yearlyRule']->setData('byMonth');
                    $forms['yearlyByMonthByMonth']->setData(
                        explode(',', strtolower($rrule['BYMONTH']))
                    );
                }
            }

            if (isset($rrule['COUNT'])) {
                $forms['untilRule']->setData('count');
                $forms['untilCount']->setData(
                    $rrule['COUNT']
                );
            } elseif (isset($rrule['UNTIL'])) {
                $forms['untilRule']->setData('date');
                $forms['untilDate']->setData(
                    \DateTime::createFromFormat('Ymd\T000000\Z', $rrule['UNTIL'])
                );
            }
        }
    }

    public function mapFormsToData($forms, &$viewData)
    {
        /** @var FormInterface[] $forms */
        $forms = iterator_to_array($forms);

        $viewData = null;

        if ($forms['freq']->getData() !== 'none') {
            $result = [];
            $result[] = 'FREQ=' . strtoupper($forms['freq']->getData());
            $result[] = 'INTERVAL=' . $forms['interval']->getData();

            if ($forms['freq']->getData() === 'weekly') {
                $result[] = 'BYDAY=' . strtoupper(implode(',', $forms['weekday']->getData()));
            }

            if ($forms['freq']->getData() === 'monthly') {
                if ($forms['monthlyRule']->getData() === 'byMonthDay') {
                    $result[] = 'BYMONTHDAY=' . strtoupper(implode(',', $forms['monthlyMonthDay']->getData()));
                } elseif ($forms['monthlyRule']->getData() === 'byDay') {
                    $result[] = 'BYDAY=' . strtoupper($forms['monthlyByDayWeekday']->getData());
                    $result[] = 'BYSETPOS=' . strtoupper($forms['monthlyByDayPos']->getData());
                }
            }

            if ($forms['freq']->getData() === 'yearly') {
                if ($forms['yearlyRule']->getData() === 'oneMonth') {
                    $result[] = 'BYMONTHDAY=' . strtoupper($forms['yearlyOneMonthDay']->getData());
                    $result[] = 'BYMONTH=' . strtoupper($forms['yearlyOneMonthByMonth']->getData());
                } elseif ($forms['yearlyRule']->getData() === 'byMonth') {
                    $result[] = 'BYMONTH=' . strtoupper(implode(',', $forms['yearlyByMonthByMonth']->getData()));
                } elseif ($forms['yearlyRule']->getData() === 'byDay') {
                    $result[] = 'BYDAY=' . strtoupper($forms['yearlyByDayWeekday']->getData());
                    $result[] = 'BYSETPOS=' . strtoupper($forms['yearlyByDayPos']->getData());
                    $result[] = 'BYMONTH=' . strtoupper($forms['yearlyByDayByMonth']->getData());
                }
            }

            if ($forms['untilRule']->getData() === 'count') {
                $result[] = 'COUNT=' . $forms['untilCount']->getData();
            } elseif ($forms['untilRule']->getData() === 'date') {
                $result[] = 'UNTIL=' . $forms['untilDate']->getData()->format('Ymd\T000000\Z');
            }

            $viewData = implode(';', $result);
        }
    }

    private function extractRule(string $viewData)
    {
        $result = [];
        $ruleItems = explode(';', $viewData);

        foreach ($ruleItems as $ruleItem) {
            $ruleParts = explode('=', $ruleItem);
            $result[$ruleParts[0]] = $ruleParts[1];
        }

        return $result;
    }
}
