<img src="/assets/ferry.png" style="float:left"/>
<h1>{title}</h1>
<div style="clear:both"></div>
<hr/>
<h4>From {origin} to {destination}</h4>
<div class="{alerting}">
    {errormessages}
</div>
<table class="table">
    <tr>
        <th>Leaves</th>
        <th>Arrives</th>
        <th>Stops</th>
    </tr>
    {sailings}
    <tr>
        <td>{depart}</td>
        <td>{arrive}</td>
        <td>{stops}</td>
    </tr>
    {/sailings}
</table>
<hr/>
<a href="/">Home</a>