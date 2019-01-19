Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Graph Partitioning Result'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.name}',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Jumlah Anggota',
    colorByPoint: true,
    data: [{
      name: 'Produk Buah-buahan',
      y: 107,
    }, {
      name: 'Produk Sayur-sayuran',
      y: 111
    }, {
      name: 'Produk Olahan Telur dan Daging',
      y: 109
    }, {
      name: 'Bumbu Makanan',
      y: 110
    }, {
      name: 'Produk Coklat dan Susu',
      y: 113
    }, {
      name: 'Perasa',
      y: 106
    }, {
      name: 'Produk Ikan dan Kacang',
      y: 107
    }, {
      name: 'Produk Mie dan Makanan Ringan 1',
      y: 113
    }, {
      name: 'Produk Mie dan Makanan Ringan 2',
      y: 113
    }]
  }]
});