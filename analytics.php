<h2>Analytics</h2>
<div id="menu" class="toggle">
    <form id="major" onSubmit= "Javscript:loadChart()" method="POST">
      <select id="major_choices" name ="choices">
        <option value = "All">--choose one--</option>
        <option value="All">All</option>
        <option value="Computer Science">Computer Science</option>
        <option value="Economics">Economics</option>
        <option value="Political Science">Political Science</option>
        <option value="Mechanical Engineering">Mechanical Engineering</option>
      </select>

      <select id="class_choices" name="classyear">
        <option value="All">--choose one--</option>
        <option value="All">All</option>
        <?php
          for ($year=1960; $year<=2014; ++$year){
            print <<<HTMLBLOCK
              <option value="$year">$year</option>
HTMLBLOCK;
          }
          ?>
        </select>
          <input type='submit'/>
    </form>
</div>
<div id="chartarea"></div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script>
function loadChart(){ 
          var e=document.getElementById("major_choices");
          var chosen_Major=e.options[e.selectedIndex].text;
          var f=document.getElementById("class_choices");
          var chosen_Class=f.options[f.selectedIndex].text;
          $("#chartarea").load("analyzeResults.php?major="+chosen_Major+"&class="+chosen_Class);
}
</script>