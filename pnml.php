<html>
<?php include 'header.php'; ?>

<h1>Using ITS to analyze PNML specifications.</h1>
<p>
	ITS-tools is happy to offer support for iso-15909 compliant Petri nets : P/T nets (iso-15909-1) and high level
	Petri nets (iso-15909-2). This iso standard defines a standard exchange format for Petri nets.
	We provide transformation(s) to GAL for analysis.
</p>

<a name="toc"></a>
<?php TableOfContents(__FILE__, 4); ?>


<h2><a name="sec:Install"></a>I. Install </h2>

<p>Please follow <a href="itstools.php#sec:modinst">these guidelines</a> to install ITS modeler.</p>

<p> Once ITS modeler is installed, you must install <a href="">PNML framework</a> (PNMLFW), a tool provided
by Lom Hillah et al. (LIP6) that implements an EMF compliant parse of PNML models. To do this, 
use "Help->Install New Software", add the PNMLFW update site : "http://" and install the "PNML" category.</p>

<p> Finally install the actual transformation plugin, that depends on GAL and PNMLFW packages, from a third update site.
Go again to "Help->Install New Software", add the PNML2GAL update site : "http://" and install the "PNML to GAL" category.

<p>You should now be able to right-click .pnml files and ask for translation to GAL.
</p>

<h2><a name="sec:pnml2gal"></a>II. PNML to GAL conversion</h2>

<h3><a name="ssec:PNMLtransfo"></a>1. Description of the transformation</h3>


<p> The conversion of P/T nets to GAL is quite direct. 
<ol>
<li>Each place produces a GAL variable. 
</li>
<li>
Each transition produces a GAL transition. 
<ol>
<li>The guard of
the transition is a conjunction of the transition firing conditions, 
as captured by the arcs connecting to the transition. 
</li>
<li>
Similarly, the GAL
transition body updates place markings according to the arc definitions.
</li>
</ol>
</li>
</ol>
</p>

<p> The conversion of HLPN follows the same structure, but due to annotations
is a bit more involved. </p>

<p>
<ol>
<li>All elementary domains D (also called colours) defined in an HLPN specification are finite (they can be
enumerated or defined through ranges etc...). We map each domain 
declaration to a GAL typedef declaration, containing |D| elements (0 to |D|-1). 
</li>
<li>Each place produces an array, of size consistent
with number of different tokens it can contain (i.e. the size of the crossproduct
of the domain).</br> For instance, if colour A is [1,2] and colour B is [3,4], a place
with domain the cross product AxB will produce an array of size 4 (the cells 
giving the number of occurrences of (1,3), (1,4), (2,3), (2,4) respectively).
</li>
<li> The various expressions corresponding to token references (arc annotations, initial marking definition) are 
appropriately translated to references in the appropriate array cell. For successor/predecessor operations on 
circular type D, we use succ($p,x) = ($p+x)% |D| and pred($p,x) = ($p + |D| -x )% |D|. 
</li>
<li> Each transition produces a GAL transition. The transition is analyzed to find all 
the formal parameters it has on both guard and connected arcs. HLPN parameters
are defined over given elementary colour domain, so corresponding GAL parameters
referring to the appropriate typedef are introduced.
<ol>
<li>The guard is a conjunction of the HLPN guard expression with constraints 
deriving from arcs that touch the transition. These constraints can use formal parameters
as necessary.
</li>
<li>The body of the transition reflects the effects of the arcs touching the transition, and can use
formal parameters as needed.
</li>
</ol>
</li>
</ol>
</p>

<div class="toplink" align="right">
	<a href="#toc">Start of page <img alt="" src="images/up.gif"
		width="13" height="12" border="0"></a>
</div>

<h3><a name="ssec:importPNML"></a>2. Invoking the tool</h3>

<p>
Analysis is performed by first translating the model to <a href="gal.php">GAL</a>. 
<ol>
<li> Right click the pnml file in Eclipse, then select action "PNML to GAL -> Transform to GAL".
You can also select a set of files or a folder it will recursively find .pnml files. </li>
<li> You will obtain two GAL image files for each input pnml file. One of them contains the translation result, with extension .gal,
the other is the simplified model .flat.gal you should actually use for verification.
</li>
</ol>
</p>

<p> The parametric model is not significantly larger than the input PNML, and is commented so one can trace the transformation.
The flat model in a way is equivalent to a P/T net obtained by unfolding colour (i.e. degeneralizing the HLPN net to a P/T net, 
not to be confused with McMillan style prefix unfoldings). 
However, the flat model includes many rewritings some of which are subtle or not immediately obvious.
In many cases (over the <a href="http://mcc.lip6.fr">models of Petri nets model-checking contest</a>) 
the flat gal has reasonable size while no P/T net equivalent can be produced due to polynomial 
size explosion of degeneralizing the net. This allows to analyze some HLPN with its-tools that 
Lola for instance cannot even parse, since no low-level P/T net representation is available.
<ol>
<li> If the initial model had colours, the .gal model will contain parameters, which are simplified away (degeneralized)
in the flat model. We heavily use the <a href="gal.php#separate">parameter separation mechanism</a> to avoid explosion in 
number of transitions. The parameter separation algorithm embeds a parameter identification procedure, that fuses parameters
$x and $y in presence of a guard $x==$y (this rule is activated on some mcc@ICATPN examples).
</li>
<li> Simplifying parameters away through instantiation also includes removing (on-the fly during degeneralization)
 any transition whose guard is false. This happens most often due to HLPN transition guard. This may entirely
 discard all transitions bearing a given label l ; by propagation calls to l are replaced by abort instructions.
 Any sequence of statements containing an abort is equivalent to a single abort. Any transition whose body is abort
 can be discarded. The process is iterated to convergence. The presence of calls in the specification is due 
 to parameter separation.
</li>
<li> An analysis (based on read and write sets of GAL statements) allows to reorder commutative statements of a transition body. In HLPN case, we are 
ensured that body effects are indeed commutative, each one corresponds to an arc (they are independent up to
 choice of parameter values). Consecutive updates on the same variable are merged (x=x+1 and x=x-1 give x=x+0 which is simplified to x=x).
 Empty effects ("x=x") are removed. As an immediate side-effect, this rule virtually replaces any pair of input/output arcs to
  a given place by a test arc, since we end up with only a clause in the guard, and no effects in the transition body.
</li>
<li> An analysis tries to find constants, i.e. places whose marking is structurally fixed. Any GAL variable that is never assigned
to in any transition body is a constant obviously. In the simple case, we replace the variable by its value everywhere it occcurs
 and discard the variable. In the array case we perform this analysis for each cell of the array, but the array itself is only
 discarded if all its cells are constants, to avoid messing up index expressions. Note that the previous rewriting of statement merging 
 makes constant identification an easier job.
</li>
</ol>
Other rewriting optimizations also occur, but the four mentionned above have the strongest (beneficial) effects for HLPN in our experiments. 
</p>

  <p>
   Mail us ddd@lip6.fr if you have any feature requests or bugs to report on this PNML module.
</p>


<h2><a name="sec:bench"></a>3. Experiments with PNML models</h2>

<p> We have run some benchmark experiments to measure how its-tools handles models from the <a href="http://mcc.lip6.fr">Model Checking contest
at Petri nets conference</a> benchmarks. ITS-tools won several categories of the contest, and significantly enough was sole
competitor for some of the larger HLPN examples, unavailable as P/T nets.</p>

 
<h2><a name="sec:Ack"></a>Acknowledgements </h2>

<p> The PNML translation, the rewriting rules and associated plugins were developped by Yann Thierry-Mieg, mostly to participate in mcc@PetriNets :D 
</p>
  
<!-- #EndEditable -->
<?php include 'footer.php'; ?>

</html>