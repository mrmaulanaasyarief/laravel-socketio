<script>
    // GAUGE
    var compas = new RadialGauge({
        renderTo: 'compas',
        minValue: -180,
        height: 150,
        width: 150,
        maxValue: 180,
        majorTicks: [
            "N",
            "NE",
            "E",
            "SE",
            "S",
            "SW",
            "W",
            "NW",
            "N"
        ],
        minorTicks: 22,
        ticksAngle: 360,
        startAngle: 0,
        strokeTicks: false,
        highlights: false,
        colorPlate: "transparent",
        colorMajorTicks: "#9eabec",
        colorMinorTicks: "#ddd",
        colorNumbers: "#ccc",
        colorNeedle: "#121c47",
        colorNeedleEnd: "#9eabec",
        valueBox: false,
        valueTextShadow: false,
        colorCircleInner: "#fff",
        colorNeedleCircleOuter: "#ccc",
        needleCircleSize: 15,
        needleCircleOuter: false,
        animationRule: "linear",
        needleType: "arrow",
        needleStart: 30,
        needleEnd: 50,
        needleWidth: 3,
        borders: true,
        borderInnerWidth: 0,
        borderMiddleWidth: 0,
        borderOuterWidth: 10,
        colorBorderOuter: "#ccc",
        colorBorderOuterEnd: "#ccc",
        colorNeedleShadowDown: "#222",
        borderShadowWidth: 0,
        animationTarget: "plate",
        animationDuration: 1500,
        value: 0,
        animatedValue: true,
        animationRule: "dequint",
    }).draw();
    // var acl = new RadialGauge({
    //     renderTo: 'acl',
    //     minValue: 0,
    //     maxValue: 8,
    //     height: 150,
    //     width: 150,
    //     majorTicks: [
    //         "3",
    //         "4",
    //         "5",
    //         "-2",
    //         "-1",
    //         "0",
    //         "1",
    //         "2",
    //         "3"
    //     ],
    //     minorTicks: 5,
    //     ticksAngle: 360,
    //     startAngle: 180,
    //     strokeTicks: false,
    //     highlights: false,
    //     colorPlate: "transparent",
    //     colorMajorTicks: "#f5f5f5",
    //     colorMinorTicks: "#ddd",
    //     colorNumbers: "#ccc",
    //     colorNeedle: "#121c47",
    //     colorNeedleEnd: "#9eabec",
    //     valueBox: false,
    //     valueTextShadow: false,
    //     colorCircleInner: "#fff",
    //     colorNeedleCircleOuter: "#ccc",
    //     needleCircleSize: 15,
    //     needleCircleOuter: false,
    //     animationRule: "linear",
    //     needleType: "arrow",
    //     needleStart: 30,
    //     needleEnd: 50,
    //     needleWidth: 3,
    //     borders: true,
    //     borderInnerWidth: 0,
    //     borderMiddleWidth: 0,
    //     borderOuterWidth: 10,
    //     colorBorderOuter: "#ccc",
    //     colorBorderOuterEnd: "#ccc",
    //     colorNeedleShadowDown: "#222",
    //     borderShadowWidth: 0,
    //     animationDuration: 1500,
    //     value: 0 + 5,
    //     animatedValue: true,
    //     animationRule: "dequint",
    // }).draw();
    var altmeter = new LinearGauge({
        renderTo: 'altmeter',
        width: 100,
        height: 150,
        minValue: 0,
        maxValue: 20000,
        units: "meter",
        borders: false,
        majorTicks: [
            "0",
            "5000",
            "10000",
            "15000",
            "20000"
        ],
        colorPlate: 'transparent',
        colorNumbers: "#FFFFFF",
        colorNeedle: "#9eabec",
        colorNeedleEnd: "#9eabec",
        animatedValue: true,
        animationRule: "dequint",
    }).draw();
    var gauge = new RadialGauge({
        renderTo: 'speedo',
        width: 150,
        height: 150,
        units: "Km/h",
        minValue: 0,
        maxValue: 10,
        majorTicks: [
            "0",
            "20",
            "40",
            "60",
            "80",
            "100"
        ],
        minorTicks: 5,
        strokeTicks: true,
        colorPlate: "transparent",
        colorMajorTicks: "#f5f5f5",
        colorMinorTicks: "#ddd",
        colorNumbers: "#ccc",
        borderShadowWidth: 0,
        colorNeedle: "#121c47",
        colorNeedleEnd: "#9eabec",
        borders: false,
        needleType: "arrow",
        needleWidth: 4,
        needleCircleSize: 7,
        needleCircleOuter: true,
        needleCircleInner: false,
        animationDuration: 1500,
        animationRule: "dequint",
        animatedValue: true,
        // animateOnInit: true
    }).draw();
    var temperature = new LinearGauge({
        renderTo: 'temperature',
        width: 100,
        height: 150,
        units: "°C",
        minValue: 0,
        maxValue: 100,
        majorTicks: [
            "0",
            "20",
            "40",
            "60",
            "80",
            "100",
        ],
        minorTicks: 2,
        strokeTicks: true,
        highlights: [
            {
                "from": 50,
                "to": 100,
                "color": "rgba(200, 50, 50, .75)"
            }
        ],
        colorPlate: "transparent",
        colorMajorTicks: "#f5f5f5",
        colorMinorTicks: "#ddd",
        colorNumbers: "#ccc",
        borderShadowWidth: 0,
        borders: false,
        needleType: "arrow",
        needleWidth: 2,
        animationDuration: 1500,
        animationRule: "linear",
        tickSide: "left",
        numberSide: "left",
        needleSide: "left",
        barStrokeWidth: 7,
        barBeginCircle: false,
        animatedValue: true,
        animationRule: "dequint",
    }).draw();
</script>