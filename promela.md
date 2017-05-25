<html>
<?php include 'header.md'; ?>

<h1>Using ITS to build and analyze Promela specifications.</h1>
<p>
	ITS-tools is happy to offer support for (a subset of) Promela the original modeling language of Spin.
	We provide an Xtext based editor 
	(content-assist, correct as you type...) to edit .dve files and transformation(s) to GAL for analysis.
</p>

<a name="toc"></a>
<?php TableOfContents(__FILE__, 4); ?>


<h2><a name="sec:Install"></a>I. Install </h2>

<p>Please follow [these guidelines](itstools.md#sec:modinst) to install ITS modeler.</p>
<p>You should now be able to open a .pml file within Eclipse, let it add "Xtext nature" to your project
to enable the full featured editor.
</p>

<h2><a name="sec:Promelaeditor"></a>II. Using the Promela editor</h2>

<h3><a name="ssec:modelPromela"></a>1. Modeling with Promela</h3>
<p>In an empty project create or import an existing dve file to get started.
The syntax is explained on the webpage : [Promela description from Spin homepage](http://spinroot.com)</p>

<p> You can also use "File->New->Example...->Coloane Examples->Promela examples" to get a project containing a few tested examples from BEEM benchmark models.</p>

<p>You can use Ctrl-space to trigger auto-completion, ... In essence it's just a nice Eclipse look-n-feel coloring editor.</p>


<div class="toplink" align="right">
	<a href="#toc">Start of page <img alt="" src="images/up.gif"
		width="13" height="12" border="0"></a>
</div>

<h3><a name="ssec:importPromela"></a>2. Reading Promela into GAL</h3>

<p>
Analysis is performed by first translating the model to [GAL](gal.md). The actual transformation
is described here : [Promela translation (french pdf)](./files/PSTL_promela.pdf).
<ol>
<li> Right click the .pml file in Eclipse, then select action "Promela to GAL -> Transform to GAL".
You can also select a set of files or a folder it will recursively find .pml files. </li>
<li> You will obtain two GAL image files for each input pml file. One of them contains the translation result, with extension .gal,
the other is the simplified model .flat.gal you should actually use for verification.
</li>
</ol>
</p>

<p>The editor only recognizes files with ".pml" extension.</p>

<h2><a name="sec:bench"></a>3. Experiments with Promela models</h2>

<p> We have run some benchmark experiments to measure how its-tools handles models from the BEEM
benchmarks. The models of BEEM in promela format were succesfully read and yielded the correct number of states 
(i.e. the same as reported by Spin with partial order deactivated).</p>

 
<h2><a name="sec:Ack"></a>Acknowledgements </h2>

The various plugins, the definition of an Promela metamodel and the implementation of the 
transformation embedded in eclipse were done by Master 1 students of UPMC (2014) :  
Adrien Becchis, Fjorilda Gjermizi and Julia Wisniewsky under supervision of Yann Thierry-Mieg
 ([see PSTL report in french (pdf)](./files/PSTL_promela.pdf)). Integration and maintenance
 is done by Yann Thierry-Mieg.
  
<!-- #EndEditable -->
<?php include 'footer.md'; ?>

</html>