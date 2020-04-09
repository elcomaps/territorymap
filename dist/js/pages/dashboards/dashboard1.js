$(function () {
    'use strict';

    // ==============================================================
    // domains
    // ==============================================================
    var chart = new Chartist.Line(
        '.domain-statistics', {
            labels: ['Jun 1', 'Jun 5', 'Jun 10', 'Jun 15', 'Jun 20', 'Jun 25', 'Jun 30'],
            series: [
                [1, 1.9, 1.1, 2.2, 1.5, 2.6, 1.6],
                [0.5, 1.1, 0.6, 1.9, 0.9, 1.7, 1]
            ]
        }, {
            low: 0,
            high: 3,
            showArea: true,
            fullWidth: true,
            plugins: [Chartist.plugins.tooltip()],
            axisY: {
                onlyInteger: true,
                scaleMinSpace: 40,
                offset: 20,
                labelInterpolationFnc: function (value) {
                    return value + 'k';
                }
            }
        }
    );

    // Offset x1 a tiny amount so that the straight stroke gets a bounding box
    // Straight lines don't get a bounding box
    // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
    chart.on('draw', function (ctx) {
        if (ctx.type === 'area') {
            ctx.element.attr({
                x1: ctx.x1 + 0.001
            });
        }
    });

    // Create the gradient definition on created event (always after chart re-render)
    chart.on('created', function (ctx) {
        var defs = ctx.svg.elem('defs');
        defs
            .elem('linearGradient', {
                id: 'gradient',
                x1: 0,
                y1: 1,
                x2: 0,
                y2: 0
            })
            .elem('stop', {
                offset: 0,
                'stop-color': 'rgba(255, 255, 255, 1)'
            })
            .parent()
            .elem('stop', {
                offset: 1,
                'stop-color': 'rgba(64, 196, 255, 1)'
            });
    });

    var chartinit = [chart];

});