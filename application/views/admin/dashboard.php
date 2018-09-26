
    <div class="row">
    <div class="col s10 center dashtitle">
        <h1 style="font-size:2rem; margin-left:3rem;"><strong>TABLEAU DE BORD MK PARTNAIR.COM</strong></h1>
    </div>      
</div> 
<article class="row">
    <div class="col s10 center logomiddash">
    <?= img('logo.jpg', 'mk partnair affretement d\'avion', 'responsive-img logo-admin' )?>
    </div>
</article>

<!-- ESPACE GOOGLE -->
<div class="row">
    <div class="col s10 center">
        <article id="auth-button" style="margin-left:2.5rem; margin-top:1rem;"></article>
        <article id="view-selector"  class="col s10 offset-s2"></article>
        <article id="timeline"  class="col s10 offset-s2"></article>
    </div>
</div>


<!-- SCRIPT DE CONNEXION ET REMONTEE DES DONNEES -->

<script>
(function(w,d,s,g,js,fjs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
  js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
}(window,document,'script'));
</script>

<script>
gapi.analytics.ready(function() {

  // Step 3: Authorize the user.

  var CLIENT_ID = '313256135998-uqg1opmmlet4hgbgi7jqnmuk9385vvuk.apps.googleusercontent.com';

  gapi.analytics.auth.authorize({
    container: 'auth-button',
    clientid: CLIENT_ID,
  });

  // Step 4: Create the view selector.

  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector'
  });

  // Step 5: Create the timeline chart.

  var timeline = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '45daysAgo',
      'end-date': 'today',
    },
    chart: {
      type: 'LINE',
      container: 'timeline'
    }
  });

  // Step 6: Hook up the components to work together.

  gapi.analytics.auth.on('success', function(response) {
    viewSelector.execute();
  });

  viewSelector.on('change', function(ids) {
    var newIds = {
      query: {
        ids: ids
      }
    }
    timeline.set(newIds).execute();
  });
});
</script>
