<html>
<?php include 'header.md'; ?>

<h1>How to install the SDD/DDD library and ITS tools.</h1>
<a name="toc"></a>

Download instructions :
<ul>
<li> [for libddd ](libddd.md#sec:libddd)
</li><li>[for ITS Modeler eclipse front-end](itstools.md#sec:modinst)
</li><li>[for ITS tools command-line](itstools.md#sec:cldl)
</li><li>[for source distributions of libits and related tools](itstools.md#sec:libitsdl)
</li>
</ul>

<p> We are grateful to [JetBrains](http://www.jetbrains.com) and their open-source project support policy, that allows us to use the excellent
continuous integration server [Teamcity</a> (see our setup at <a href="http://teamcity-systeme.lip6.fr">teamcity-systeme.lip6.fr](http://www.jetbrains.com/teamcity/)).
This allows us to easily build, test and distribute these tools for your convenience and ours.    
</p>
<a href="http://www.jetbrains.com/teamcity/">
<img src="images/teamcity.png" alt="Try Teamcity !" />
</a>

<h1>Developer's corner : setting up Eclipse to write a GAL conversion.</h1>

<p>
Due to popular demand, here are a few basic instructions to get an eclipse running in development mode.
<ol>
  <li> Download Eclipse, we recommend "DSL developer" so you will get Xtext packaged in the bundle. Otherwise, install plugins Xtext and Xtend 
  from eclipse release site into existing (>= Luna) eclipse.</li>
  <li> Update eclipse to install a subversion plugin. Basically, first install Subversive from the normal eclipse releases site. Reboot.</li>
  <li> With the plugin deployed, under perspectives you have SVN "repository explorer", open that. Depending on your platform, you may get a message
  asking to download additional "connectors", you do need them. Choose the "Pure java connector" solution it works mostly everywhere. Reboot.</li>
  <li> On the left, right click, and add a SVN repository with url : https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL. Use 
  your login/password if you have one (mail me ddd@lip6.fr if you'd like an account) or anonymous/anonymous for read only access.</li>
  <li> Right-click, then "Checkout" the three projects named fr.lip6.move.gal, fr.lip6.move.gal.ui, fr.lip6.move.gal.tests.</li>
  <li> Back in Java perspective, in the project fr.lip6.move.gal navigate in the folder src/ to package fr/lip6/move/gal, and right-click
  "Run As...->MWE2 workflow" the .mwe2 file. Hit "y" when it asks for permission to download antlr.</li>
  <li> Install all the dependecies of GAL, select "Help->install new software" and install ITS modeler as explained for plain users here : [for ITS Modeler eclipse front-end](itstools.md#sec:modinst).
   Reboot.</li>
  <li> There should be no more compilation errors, you can inspect the GAL grammar (.xtext) and its metamodel as well as the utility classes provided (in particular we recommend use of class GF2 static factory operations rather than
  direct use of EMF generated GalFactory).</li> 
</ol>
</p>

<p>
We use maven to build the actual plugins. Example maven pom.xml configuration files are available
to allow to quickly setup an update site. Please contact us (ddd@lip6.fr) if you'd like some help supporting this scenario.
</p>


<div class="toplink" align="right">[Start of page <img alt="" src="images/up.gif" width="13" height="12" border="0">](#toc)</div>

<!-- #EndEditable -->
<?php include 'footer.md'; ?>
</html>
