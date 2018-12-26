let chartData = [];
let nowDate = new Date();
let str= nowDate.getFullYear()+'-'+(nowDate.getMonth()+1)+'-'+nowDate.getDate();

for(let i=0; i<=30; i++){
        let month;
        let r = nowDate.getDate()-1;
    nowDate.setDate(Math.abs(r));
        let day = nowDate.getDate()<10?'0'+nowDate.getDate():nowDate.getDate();
        r<0?month=nowDate.getMonth()<10?'0'+nowDate.getMonth():nowDate.getMonth():month = nowDate.getMonth()+1<10?'0'+parseInt(nowDate.getMonth()+1):nowDate.getMonth()+1;
        let year = new Date().getFullYear();
        chartData.push({
            date:year+'-'+month+'-'+(day+1)
        })
}
chartData.forEach(function (obj, j) {
    if(!obj.distance&&obj.date<=str){
        let person=Math.round(Math.random()*(200/5))
        let company=Math.round(Math.random()*(100/5))
        let current=(person+company)

        obj.person= person,
            obj.company= company,
        obj.current= current

    }
    if(obj.date == str){
        obj.bulletClass= "lastBullet"
    }
})
chartData.reverse()
let chart = AmCharts.makeChart("chartdiv", {
    type: "serial",
    theme: "dark",
    dataDateFormat: "YYYY-MM-DD",
    dataProvider: chartData,
    addClassNames: true,
    startDuration: 1,
    color: "#FFFFFF",
    marginLeft: 0,
    valueAxes: [{
        id: "a1",
        title: "",
        gridAlpha: 0,
        axisAlpha: 0
    }, {
        id: "a2",
        position: "right",
        title:'',
        gridAlpha: 0,
        axisAlpha: 0,
        labelsEnabled: false
    }],
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
    graphs: [{
        id: "g1",
        valueField: "current",
        title: "当前提报(一个月内)",
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
        valueField: "person",
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
        labelPosition: "top",
        showBalloon: true,
        animationPlayed: true,
    }, {
        id: "g3",
        title: "法人单位",
        valueField: "company",
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
