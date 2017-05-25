<html>
<?php include 'header.md'; ?>

<h1>Using ITS to build and analyze Timed Automata.</h1>
<p>
	ITS-tools is happy to offer support for Timed Automata, in a discrete time setting.
	Alpha-Stage Warning : this tool is still very young, and may exhibit strange features (read bugs).
	Some effort has been invested in providing compatibility with
	the reference Timed Automata tool [Uppaal](http://www.uppaal.org)
	and providing a decent editing front-end. The plugin offers an Xtext based editor 
	(content-assist, correct as you type...) to edit .xta files which is [the textual syntax of Uppaal v4](http://www.it.uu.se/research/group/darts/uppaal/help.md?file=FileFormats.shtml).
</p>

<a name="toc"></a>
<?php TableOfContents(__FILE__, 4); ?>


<h2><a name="sec:Install"></a>I. Install </h2>

<p>Please follow [these guidelines](itstools.md#sec:modinst) to install ITS modeler.</p>
<p>To obtain an .xta file from Uppaal choose "File... Save As" then give the file a .xta extension.</p>
<p>Please note that this is a very early alpha-release, we appreciate your feedback.
We did manage to read in all the models included in Uppaal distribution so there is tested support
for variables, templates, template parameters, instantiation, local clocks, locations, transitions,
 arithmetic, urgent locations, and location invariants.   
This version currently does not support Function declarations or array variables. There are known issues
 with global clocks and with commit states currently.
</p>

<h2><a name="sec:TPNeditor"></a>II. Using the XTA editor</h2>

<h3><a name="ssec:modelTPN"></a>1. Modeling with Discrete Timed Automata</h3>
<p>In an empty project create or import an existing xta file to get started.
The syntax is explained in summarized in the BNF [here](http://people.cs.aau.dk/~adavid/utap/syntax.html)
and explained in much more detailed form in <a href=http://www.it.uu.se/research/group/darts/uppaal/help.md?file=System_Descriptions/Model.shtml">the reference manual</a>.
</p>

<p> You can also use "File->New->Example...->Coloane Examples->Timed Automata" to get a project containing a few tested examples from Uppaal distribution.</p>

<p>You can use Ctrl-space to trigger auto-completion, ... In essence it's just a nice Eclipse look-n-feel coloring editor.</p>

<p>Note that the interpretation (semantics) will be in discrete time instead of Uppaal's dense time hypothesis.
So keep in mind that x &lt; k  will be interpreted as x &le; k-1.
</p>
<p>
In general, it is preferable to use only open bounds (always use &le; and &ge; rather than &lt; and &gt;).
If this condition is respected, analysis in discrete and dense time settings coincide; hence you are guarantedd
 to get the same analysis results as with Uppaal. 
</p>

<p>
Note that for most models the fact we are using a discrete time setting for analysis is not really significant with regards to analysis results.
</p>

<div class="toplink" align="right">
	<a href="#toc">Start of page <img alt="" src="images/up.gif"
		width="13" height="12" border="0"></a>
</div>

<h3><a name="ssec:importTA"></a>2. Reading Timed Automata into GAL</h3>

<p>
Analysis is performed by first translating the model to [GAL](gal.md). The actual transformation
is described here : [Experiments with XTA (pdf)](./files/xta-bench.pdf).
<ol>
<li> Right click the xta file in Eclipse, then select action "TA to GAL -> Transform to GAL" either Essential States or One-step.
You can also select a set of files or a folder it will recursively find .xta files. </li>
<li> You will obtain two GAL image files for each input xta file. One of them contains the translation result, with extension .pop if it uses essential states semantics, and .one if
it uses one time step semantics. The file with extension .flat.gal is a simplified output from the GAL post-analysis
rewritings, that can be passed with flag "-t GAL" to command line its-tools.</li>
</ol>
</p>


<h2><a name="sec:bench"></a>3. Experiments with Timed Automata</h2>

<p> We have run some benchmark experiments to measure how its-reach scales with respect to Uppaal
 on some of these Timed Automata models. Overall, Uppaal is much more resistant to high clock limit 
 values, but its-reach supports much higher number of concurrent processes provided maximum clock values
  remain small.</p>

  <p> The results of these experiments are reported here : [Experiments with XTA (pdf)](./files/xta-bench.pdf). 
  The rest of this section is technical instructions allowing to reproduce our experiments.</p>
  
<p> The benchmark constitutes in 3 models declined with various number of process, and various clock bound settings.
In total there are 265 XTA model instances and 530 GAL model instances (one with One-step and one with Essential States semantics).</p>

<p> The models are taken from [Uppaal benchmark suite](www.it.uu.se/research/group/darts/uppaal/benchmarks/) : 
<ol>
<li> FDDI token ring protocol : (folder hddi) we have three parameters, i number of process, j a multiplier, k a constant.
We use definitions : [SA=k, TRTT=(K+i*j)](https://srcdev.lip6.fr/trac/research/thierry/browser/PSTL/GAL/fr.lip6.move.xta.benchmarks/hddi/tokenring.gen.awk).
We use sample values : i in "02 03 05 07  10 15 20 25 30", j in "1 2 5 10 20", k in "0 1 10 50".
</li>
<li> Fischer mutual exclusion : (folder fischer) we have two parameters, i the number of process, and K the bound on clocks.
We use sample values : i in "02 03 05 07 10 15 20 25 30 50", K in "02 04 08 16"</li>
<li> CSMA CD Collision Detection : we have two parameters, i the number of process and C the clock definition values. We use : 
   (C == 1) SA = 1, SB = 2, TRTT = 3; (C == 2) SA = 2, SB = 4, TRTT = 8;  (C == 3) SA = 13, SB = 26, TRTT = 55; 
   (C == 4) SA = 26, SB = 52, TRTT = 808; 
   Sample values are : i in "02 03 05 07 10 15 20 25 30", C in "1 2 3 4 5".</li>
</ol>
</p>

<p> To reproduce these experiments, you can checkout this project : <br/> "svn co https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL/fr.lip6.move.xta.benchmarks", using anonymous/anonymous as login/password pair.</p>

<h5>Generating the benchmark example files.</h5>

<p> You will need 
<ul>
<li>a bash environment including make, awk, perl.</li>
<li>An eclipse [ITS Modeler front-end](itstools.md#sec:modinst) deployed, since we currently lack command-line version of the transformation tool.</li>
</ul>
</p>

<p> Once you have these elements, 
<ol>
<li>Run "make gen", this should produce a (large) set of *.xta files.</li>
<li>To produce the GAL files, we now need to run Eclipse, then select "File->Import->Existing Projects into Workspace" and point it to the root folder you checked out earlier.</li>
<li>In the project obtained, select the root folder then "right-click->TA to GAL->Transform to GAL (Essential States)". 
This will recursively apply the transformation to all ".xta" files in subfolders.  
The transformation is quite long due to the high number of files (and there is no progress monitor, sorry), please be patient (or do it separately for each folder).</li>
<li>Rinse and repeat : also select translation "Transform to GAL (Time unit Step)"</li>
<li>Make sure you have indeed built "*.one.flat.gal" (one unit time step) and "*.pop.flat.gal" (Popova's Essential States semantics). You can then quit Eclipse.</li> 
</ol>
</p> 

<h5>Analyzing the benchmark example files.</h5>

<p> You will need :
<ul>
<li>a compiled distribution of Uppaal (we used the latest 4.1.16).</li>
<li>a compiled distribution of Memtime (we used [this version.](http://tiger.cs.tsinghua.edu.cn/Students/yangjl/memtime/)</li>
<li>the [command-line distribution of its-tools](http://move.lip6.fr/software/DDD/itstools.md#sec:cldl) (only its-reach really used) </li> 
</ul>

<p> Once you have these elements, 
<ol>
<li>Edit the top of the Makefile (at the root of the checkout folder) to point to your binaries. 
You can also set higher or smaller timeout and out of memory thresholds.</li>
<li>Run "make perfs", be prepared to wait for a while (several hours total with default 10 minute timeout). </li>
<li>You should now have files titled "trace.out" and "upptrace.out" in each of the example folders, containing raw traces from the tools.</li>
<li>Run "make trace.csv" to have the perl scripts post-analyze the traces to grab relevant info 
(detect successful runs, timeouts, out of memory, and grab memory and time stats). You will obtain a trace.csv file.</li>
<li>Open and examine the CSV file using your favorite spreadsheet editor. Running "make stats" will show general stats.
Running "make plots" will build graphical scatter plots (eps files) comparing the techniques.
</ol>
</p>
  
<h2><a name="sec:Ack"></a>Acknowledgements </h2>

The various plugins and the definition of an XTA metamodel were done by Yann Thierry-Mieg.
The transformation was built by Yann Thierry-Mieg and Maximilien Colange.


<!-- #EndEditable -->
<?php include 'footer.md'; ?>

</html>