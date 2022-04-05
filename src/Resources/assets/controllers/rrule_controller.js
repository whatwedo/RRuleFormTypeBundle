import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        'rrule',
        'freq',

        'interval',

        'weekly',
        'weekday',

        'monthly',
        'monthlyRule',
        'monthlyMonthDay',
        'monthlyByDayPos',
        'monthlyByDayWeekday',

        'yearly',
        'yearlyRule',
        'yearlyOneMonthByMonth',
        'yearlyOneMonthDay',
        'yearlyByMonthByMonth',
        'yearlyByDayPos',
        'yearlyByDayWeekday',
        'yearlyByDayByMonth',

        'untilRule',
        'untilCount',
        'untilDate',
    ]

    connect() {
        this.switchPanels(this.getFrequency());
        this.switchUntilRule(this.getUtilRule());
        this.switchMonthlyRule(this.getMonthlyRule());
        this.switchYearlyRule(this.getYearlyRule());
    }

    selectFreq(event) {
        this.switchPanels(this.getFrequency());
    }

    selectWeekday(event) {
        var weekdayRequired = true;
        for (var weekday of this.weekdayTargets) {
            if (weekday.checked) {
                weekdayRequired = false;
            }
        }
        for (var weekday of this.weekdayTargets) {
            weekday.required = weekdayRequired && this.getFrequency() == 'weekly';
        }
    }

    monthlyMonthDaySelect(event) {
        var monthlyMonthDayRequired = true;
        for (var monthlyMonthDay of this.monthlyMonthDayTargets) {
            if (monthlyMonthDay.checked) {
                monthlyMonthDayRequired = false;
            }
        }
        for (var monthlyMonthDay of this.monthlyMonthDayTargets) {
            monthlyMonthDay.required = monthlyMonthDayRequired && this.getFrequency() == 'monthly' && this.getMonthlyRule() == 'byMonthDay';
        }
    }

    selectYearlyByMonthByMonth(event) {
        var yearlyByMonthByMonthRequired = true;
        for (var yearlyByMonthByMonth of this.yearlyByMonthByMonthTargets) {
            if (yearlyByMonthByMonth.checked) {
                yearlyByMonthByMonthRequired = false;
            }
        }
        for (var yearlyByMonthByMonth of this.yearlyByMonthByMonthTargets) {
            yearlyByMonthByMonth.required = yearlyByMonthByMonthRequired&& this.getFrequency() == 'yearly' && this.getYearlyRule() == 'byMonth';
        }
    }

    selectUntilRule(event) {
        this.switchUntilRule(this.getUtilRule());
    }


    selectMonthlyRule(event) {
        this.switchMonthlyRule(this.getMonthlyRule());
    }

    selectYearlyRule(event) {
        this.switchYearlyRule(this.getYearlyRule());
    }

    switchPanels(freq) {
        this.rruleTarget.style.display = 'none';

        this.weeklyTarget.style.display = 'none';
        this.monthlyTarget.style.display = 'none';
        this.yearlyTarget.style.display = 'none';

        for (var untilRule of this.untilRuleTargets) {
            untilRule.required = false;
            untilRule.required = false;
        }
        this.intervalTarget.required = false;

        this.selectWeekday();

        for (var monthlyRule of this.monthlyRuleTargets) {
            monthlyRule.required = false;
        }

        for (var yearlyRule of this.yearlyRuleTargets) {
            yearlyRule.required = false;
        }

        this.monthlyByDayPosTarget.required = false;

        if (freq != 'none') {
            this.intervalTarget.required = true;
            for (var untilRule of this.untilRuleTargets) {
                untilRule.required = true;
            }
            this.rruleTarget.style.display = 'block';
        }

        if (freq == 'weekly') {
            this.selectWeekday();
            this.weeklyTarget.style.display = 'block';
        } else if (freq == 'monthly') {
            for (var monthlyRule of this.monthlyRuleTargets) {
                monthlyRule.required = true;
            }
            this.monthlyTarget.style.display = 'block';
        } else if (freq == 'yearly') {
            for (var yearlyRule of this.yearlyRuleTargets) {
                yearlyRule.required = true;
            }
            this.yearlyTarget.style.display = 'block';
        }

    }

    switchUntilRule(untilRule) {
        this.untilCountTarget.disabled = true;
        this.untilCountTarget.readOnly = true;
        this.untilCountTarget.required = false;
        this.untilDateTarget.disabled = true;
        this.untilDateTarget.readOnly = true;
        this.untilDateTarget.required = false;
        if (untilRule == 'count') {
            this.untilCountTarget.disabled = false;
            this.untilCountTarget.readOnly = false;
            this.untilCountTarget.required = true;
        } else if (untilRule == 'date') {
            this.untilDateTarget.disabled = false;
            this.untilDateTarget.readOnly = false;
            this.untilDateTarget.required = true;
        }
    }

    switchMonthlyRule(monthlyRule) {
        for (var monthlyMonthDay of this.monthlyMonthDayTargets) {
            monthlyMonthDay.readOnly = true;
            monthlyMonthDay.disabled = true;
            monthlyMonthDay.required = false;
        }
        this.monthlyByDayPosTarget.disabled = true;
        this.monthlyByDayPosTarget.readOnly = true;
        this.monthlyByDayPosTarget.required = false;
        this.monthlyByDayWeekdayTarget.disabled = true;
        this.monthlyByDayWeekdayTarget.readOnly = true;
        this.monthlyByDayWeekdayTarget.required = true;

        this.monthlyMonthDaySelect();
        if (monthlyRule == 'byMonthDay') {
            for (var monthlyMonthDay of this.monthlyMonthDayTargets) {
                monthlyMonthDay.readOnly = false;
                monthlyMonthDay.disabled = false;
            }
            this.monthlyMonthDaySelect();
        } else if (monthlyRule == 'byDay') {
            this.monthlyByDayPosTarget.disabled = false;
            this.monthlyByDayPosTarget.readOnly = false;
            this.monthlyByDayPosTarget.required = true;
            this.monthlyByDayWeekdayTarget.disabled = false;
            this.monthlyByDayWeekdayTarget.readOnly = false;
            this.monthlyByDayWeekdayTarget.required = true;
        }
    }

    switchYearlyRule(yearlyRule) {
        this.yearlyOneMonthByMonthTarget.disabled = true;
        this.yearlyOneMonthByMonthTarget.readOnly = true;
        this.yearlyOneMonthByMonthTarget.required = false;
        this.yearlyOneMonthDayTarget.disabled = true;
        this.yearlyOneMonthDayTarget.readOnly = true;
        this.yearlyOneMonthDayTarget.required = false;
        this.selectYearlyByMonthByMonth();

        for (var yearlyByMonthByMonth of this.yearlyByMonthByMonthTargets) {
            yearlyByMonthByMonth.disabled = true;
            yearlyByMonthByMonth.readOnly = true;
        }

        this.yearlyByDayPosTarget.disabled = true;
        this.yearlyByDayPosTarget.readOnly = true;
        this.yearlyByDayPosTarget.required = false;

        this.yearlyByDayWeekdayTarget.disabled = true;
        this.yearlyByDayWeekdayTarget.readOnly = true;
        this.yearlyByDayWeekdayTarget.required = false;

        this.yearlyByDayByMonthTarget.disabled = true;
        this.yearlyByDayByMonthTarget.readOnly = true;
        this.yearlyByDayByMonthTarget.required = false;

        if (yearlyRule == 'oneMonth') {
            this.yearlyOneMonthByMonthTarget.disabled = false;
            this.yearlyOneMonthByMonthTarget.readOnly = false;
            this.yearlyOneMonthByMonthTarget.required = true;

            this.yearlyOneMonthDayTarget.disabled = false;
            this.yearlyOneMonthDayTarget.readOnly = false;
            this.yearlyOneMonthDayTarget.required = true;
        } else if (yearlyRule == 'byMonth') {
            for (var yearlyByMonthByMonth of this.yearlyByMonthByMonthTargets) {
                yearlyByMonthByMonth.disabled = false;
                yearlyByMonthByMonth.readOnly = false;
            }
            this.selectYearlyByMonthByMonth();
        } else if (yearlyRule == 'byDay') {
            this.yearlyByDayPosTarget.disabled = false;
            this.yearlyByDayPosTarget.readOnly = false;
            this.yearlyByDayPosTarget.required = true;

            this.yearlyByDayWeekdayTarget.disabled = false;
            this.yearlyByDayWeekdayTarget.readOnly = false;
            this.yearlyByDayWeekdayTarget.required = true;

            this.yearlyByDayByMonthTarget.disabled = false;
            this.yearlyByDayByMonthTarget.readOnly = false;
            this.yearlyByDayByMonthTarget.required = true;
        }
    }

    getFrequency() {
        for (var freq of this.freqTargets) {
            if (freq.checked) {
                return freq.value;
            }
        }
        return '';
    }

    getUtilRule() {
        for (var untilRule of this.untilRuleTargets) {
            if (untilRule.checked) {
                return untilRule.value;
            }
        }
        return '';
    }

    getMonthlyRule() {
        for (var monthlyRule of this.monthlyRuleTargets) {
            if (monthlyRule.checked) {
                return monthlyRule.value;
            }
        }
        return '';
    }

    getYearlyRule() {
        for (var yearlyRule of this.yearlyRuleTargets) {
            if (yearlyRule.checked) {
                return yearlyRule.value;
            }
        }
        return '';
    }
}
