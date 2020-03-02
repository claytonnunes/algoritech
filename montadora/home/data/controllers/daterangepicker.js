'use strict';

app
    .controller('DaterangepickerCtrl', function ($scope, $moment) {
        $scope.startDate = $moment().subtract(1, 'days').format('D/M/YYYY'); 
        $scope.endDate = $moment().add(31, 'days').format('D/M/YYYY'); 
        $scope.rangeOptions = {
            ranges: {
                "Hoje": [$moment().valueOf() , $moment().valueOf() ],
                "Ontem": [$moment().subtract(1, 'days').valueOf(), $moment().subtract(1, 'days').valueOf()],
                'Últimos 7 dias': [$moment().subtract(6, 'days').valueOf(), $moment().valueOf()],
                'Últimos 30 dias': [$moment().subtract(29, 'days').valueOf(), $moment().valueOf()],
                'Este Mês': [$moment().startOf('month').valueOf(), $moment().endOf('month').valueOf()],
                'Mês Anterior': [$moment().subtract(1, 'month').startOf('month').valueOf(), $moment().subtract(1, 'month').endOf('month').valueOf()]
            },
            locale: {
            format: 'D/M/YYYY',
            separator: ' - ',
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: 'De',
            toLabel: 'Para',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex','Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            firstDay: 1
            },
            opens: 'left',
            startDate: $moment().subtract(29, 'days').format('D/M/YYYY'),
            endDate: $moment().format('D/M/YYYY'),
            parentEl: '#content'
        };
});
