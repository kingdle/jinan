var chartData = [
    {
        "date": "2018-12-01",
        "distance": 227,
        "townName": "",
        "townName2": "",
        "townSize": 25,
        "latitude": 40,
        "duration": 408,
    },
    {
        "date": "2018-12-02",
        "distance": 371,
        "townName": "",
        "townSize": 14,
        "latitude": 38,
        "duration": 482
    },
    {
        "date": "2018-12-03",
        "distance": 433,
        "townName": "",
        "townSize": 6,
        "latitude": 34,
        "duration": 562
    },
    {
        "date": "2018-12-04",
        "distance": 345,
        "townName": "",
        "townSize": 7,
        "latitude": 30,
        "duration": 379
    },
    {
        "date": "2018-12-05",
        "distance": 480,
        "townName": "",
        "townName2": "",
        "townSize": 10,
        "latitude": 25,
        "duration": 501
    },
    {
        "date": "2018-12-06",
        "distance": 386,
        "townName": "",
        "townSize": 7,
        "latitude": 30,
        "duration": 443
    },
    {
        "date": "2018-12-07",
        "distance": 348,
        "townName": "",
        "townSize": 10,
        "latitude": 29,
        "duration": 405
    },
    {
        "date": "2018-12-08",
        "distance": 238,
        "townName": "",
        "townName2": "",
        "townSize": 16,
        "latitude": 29,
        "duration": 309
    },
    {
        "date": "2018-12-09",
        "distance": 218,
        "townName": "",
        "townSize": 17,
        "latitude": 32,
        "duration": 287
    },
    {
        "date": "2018-12-10",
        "distance": 349,
        "townName": "",
        "townSize": 11,
        "latitude": 35,
        "duration": 485
    },
    {
        "date": "2018-12-11",
        "distance": 603,
        "townName": "",
        "townSize": 10,
        "latitude": 39,
        "duration": 890
    },
    {
        "date": "2018-12-12",
        "distance": 534,
        "townName": "",
        "townName2": "",
        "townSize": 18,
        "latitude": 39,
        "duration": 810
    },
    {
        "date": "2018-12-13",
        "townName": "",
        "townSize": 12,
        "distance": 425,
        "duration": 670,
        "latitude": 40,
    },
    {
        "date": "2018-12-14",
        "latitude": 36,
        "distance": 425,
        "duration": 470,
        "townName": "",
        "townName2": "",
        "bulletClass": "lastBullet"
    },
    {
        "date": "2018-12-15"
    },
    {
        "date": "2018-12-16"
    },
    {
        "date": "2018-12-17"
    },
    {
        "date": "2018-12-18"
    },
    {
        "date": "2018-12-19"
    },
    {
        "date": "2018-12-20"
    },
    {
        "date": "2018-12-21"
    },
    {
        "date": "2018-12-22"
    },
    {
        "date": "2018-12-23"
    },
    {
        "date": "2018-12-24"
    },
    {
        "date": "2018-12-25"
    },
    {
        "date": "2018-12-26"
    },
    {
        "date": "2018-12-27"
    },
    {
        "date": "2018-12-28"
    },
    {
        "date": "2018-12-29"
    },
    {
        "date": "2018-12-30"
    },
    {
        "date": "2018-12-31"
    },
    {
        "date": "2019-01-01"
    },
    {
        "date": "2019-01-02"
    },
    {
        "date": "2019-01-03"
    }
];
var chart = AmCharts.makeChart("chartdiv", {
    type: "serial",
    theme: "dark",
    dataDateFormat: "YYYY-MM-DD",
    dataProvider: chartData,
    addClassNames: true,
    startDuration: 1,
    color: "#FFFFFF",
    marginLeft: 0,

    categoryField: "date",
    categoryAxis: {
        parseDates: true,
        minPeriod: "DD",
        autoGridCount: false,
        gridCount: 50,
        gridAlpha: 0.1,
        gridColor: "#FFFFFF",
        axisColor: "#555555",
        dateFormats: [{
            period: 'DD',
            format: 'DD'
        }, {
            period: 'WW',
            format: 'MMM DD'
        }, {
            period: 'MM',
            format: 'MMM'
        }, {
            period: 'YYYY',
            format: 'YYYY'
        }]
    },

    valueAxes: [{
        id: "a1",
        title: "上传进度",
        gridAlpha: 0,
        axisAlpha: 0
    }, {
        id: "a2",
        position: "right",
        title:'济宁市四经普大数据平台',
        gridAlpha: 0,
        axisAlpha: 0,
        labelsEnabled: false
    }],
    graphs: [{
        id: "g1",
        valueField: "distance",
        title: "提报单位",
        type: "column",
        fillAlphas: 0.9,
        valueAxis: "a1",
        balloonText: "[[value]]",
        legendValueText: "[[value]]",
        legendPeriodValueText: "数量: [[value.sum]] 个",
        lineColor: "#263138",
        alphaField: "alpha",
    }, {
        id: "g2",
        title: "个体户",
        valueField: "latitude",
        classNameField: "bulletClass",
        type: "smoothedLine",
        valueAxis: "a2",
        lineColor: "#786c56",
        balloonText: "[[value]]",
        lineThickness: 1,
        legendValueText: "[[value]]",
        legendPeriodValueText: "数量: [[value.sum]] 个",
        bullet: "round",
        bulletBorderColor: "#786c56",
        bulletBorderAlpha: 1,
        bulletBorderThickness: 2,
        bulletColor: "#a7f8b5",
        labelPosition: "right",
        showBalloon: true,
        animationPlayed: true,
    }, {
        id: "g3",
        title: "法人单位",
        valueField: "duration",
        classNameField: "bulletClass",
        type: "smoothedLine",
        valueAxis: "a3",
        lineColor: "#ff5755",
        balloonText: "[[value]]",
        lineThickness: 1,
        legendValueText: "[[value]]",
        legendPeriodValueText: "数量: [[value.sum]] 个",
        bullet: "round",
        bulletBorderColor: "#ff5755",
        bulletBorderAlpha: 1,
        bulletBorderThickness: 1,
        dashLengthField: "dashLength",
        animationPlayed: true
    }],

    chartCursor: {
        zoomable: false,
        categoryBalloonDateFormat: "DD",
        cursorAlpha: 0,
        valueBalloonsEnabled: false
    },
    legend: {
        bulletType: "round",
        equalWidths: false,
        valueWidth: 120,
        useGraphSettings: true,
        color: "#FFFFFF"
    }
});
