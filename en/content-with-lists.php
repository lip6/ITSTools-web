<style type="text/css">
<!--
.galElement {
	font-family:Monospace,"Courier New", Courier;
	font-weight:bold;
	color:red
	
}
-->
</style>

    <h1>Welcome to the homepage of GAL </h1>
    <p>You will find here the official documentation of the Guarded Action Language, 
	including its syntax and a description of the features of the simulator built into the ITS modeler front-end.</p>
	<p>GAL is a language providing a C-like syntax to describe concurrent systems. We provide a feature-rich editor and
	full CTL and LTL model-checking of GAL using the its-tools. </p>
    <p><strong>Contents</strong></p>
    <div id="sommaire">
	
	<?php
	TableOfContents(__FILE__, 5); 
	?>
	</div>
	
	</span>
  
<h2><a name="sec:Install"></a>I. Install </h2>

<p>Please follow [these guidelines](itstools.md#sec:modinst) to install ITS modeler.</p>
  <p> Build a new Project to get started, then create a "new->Coloane->GAL file".</p>


    <h2><a name="apercu"></a>3. Overview </h2>
    <p>&nbsp;</p>
    <p>Once ITS Modeler is installed, create a new GAL project like this: <br />
    File &rarr; New &rarr; File &rarr; Coloane &rarr; Gal file...</p>
    <p>In any project, you can simply create a file with the extension .gal, and so you can model using the GAL language.</p>

	<p> These [GAL examples](files/gal.zip) translated from the BEEM distribution can help get started as well.</p>

	
    <p><h3><a name="package-presentation"></a>3.1 Package presentation</h3></p>
    <p>Here is an example of a system written in GAL:  </p>
    <?php 
		printGalFile("galfiles/sample-1.gal");
	?>


	
    <p>This code shows the main elements of the GAL language. A GAL system 
	contains variable declarations and (possibly labeled)transitions that have a guard and an action
	that is a sequence of assignments.</p>
    <p>GAL have a simple concurrent semantic, given as a labeled Kripke structure. A state is defined as a 
	valuation of the variables. Any transition whose guard is true in the current state can be fired
	yielding a (set of) successor(s) obtained by executing each assignment of the transition in sequence.
	This interleaving semantic is adapted to modeling of concurrent systems. Semantics for 
	interleaving of GAL transitions are similar to semantics of Petri nets.</p>
    <p>At the end of this page, we describe the java API to build or manipulate GAL models programmatically.</p>


	<h2><a name="le-langage-gal"></a>4. GAL syntax </h2>
	<p>This section describes GAL through its syntax.</p>

	<h3><a name="what-is-gal"></a>4.1 What is GAL ? </h3>
	<p>GAL is an acronym for <strong>Guarded Action Language,</strong> a modelling language dedicated
	to the description of data manipulation for formal verification of concurrent systems. </p>

	<h3><a name="utilite-gal"></a>4.2 What is its purpose ? </h3>
	<p>GAL is a semantic assembly language suited to formal verification, using symbolic methods (such as Data Decision Diagrams). 
	It offers a high level of expressivity (manipulation of integer expressions, integers, etc...). 
	It is used as an intermediate language for modeling concurrent systems for verification by model-checking, and can be manipulated
	symbolically using decision diagrams ([ddd.lip6.fr](http://ddd.lip6.fr)) </p>
	<h3><a name="concepts-gal"></a>4.3 GAL concepts  </h3>


	<h4><a name="fichiers-gal" ></a>4.3.1  GAL files</h4>
	
	<p>GAL files are simple files with the extension .gal . For example, foo.gal is a valid GAL filename. </p>


	<h4><a name="systeme-gal" ></a>4.3.2  Systems in GAL</h4>
	
	<div class="story">	
	<h5><a name="sysdecl"></a> a) System declaration </h5>

	<p>A GAL system is characterized by a name, and contains a sequence of instructions that will be detailed throughout this document. </p>
	<p> Once a GAL file created and opened, all instructions are placed within a GAL declaration.
	Such a declaration starts with the keyword <span class="galElement">GAL</span> (caps), followed by the system name. 
	The name must start with a letter of the alphabet and should be a C-style identifier (only using letters, underscore and numbers).
	A good practice is to give a meaningful name to the system created, particularly if it will be reused in a Composite ITS definition.</p>
	<p>The body (variable and transitions) of the system name are then placed between a pair of braces.</p>
	<p>Here is a declaration of an example GAL system named <em>foo</em>.</p>
	<p>
	  <?php
		printGalFile("galfiles/sample-2.gal");
	?>
	</p>
	</div>
	
	<div class="story">	
	<h5><a name="sysdecl"></a> b) Type parameters </h5>
	<p>
	  A GAL system declaration can optionally declare one or more <em>type parameters</em>.
	  A type parameter essentially declares a symbolic name for an integer constant, that can then be used
	  within the various instructions of the GAL (initializations, guards, statements...).
	  Parameter names start with a $ sign to avoid any confusion with the variables of the system.
	  Parameters are given a value directly after their declaration.
	  Note that within the context of composite ITS, parameters can be given a value (different from the value given in the paramter declaration) 
	  when instantiating the GAL, thus simulating a kind of parametric constructor for the GAL.
	</p> 
	<p>
	  Syntactically, parameters are given as a parenthesized comma separated list, just after the name of the system.
	  Only integers may be used in parameter initializations. 
	</p>
	<p>
	  <?php
		printGalFile("galfiles/sample-param.gal");
	?>
	</p>		
	</div>
	
	<h4><a name="declaration-variables" ></a>4.3.3 Variables declarations </h4>
	
	<p>A GAL model declares variables. The variables manipulated in GAL can be integers or arrays of integer. 
	There are no dedicated Boolean or char basic types, nor struct declarations. Integers are 32 bit wide. </p>
	<p>In this section, we describe how variables of a GAL are declared.</p>
	<p>Plain integer variables are introduced with the keyword <span class="galElement">int</span> followed by the variable name starting with a letter.
	The variable name may contain alphanumeric characters as well as the "." character (which may help trace structs from of your source language if you are using GAL as a transformation target), 
	-- the name must be unique, so it is not assigned another meaning in the program. 
	Each variable MUST be initialized, this is doen usingthe &quot;=&quot; symbol followed by the a initial value of this variable.
	The initial value can be expressed using an integer expression built of constants and/or type parameters, but it cannot refer to other variables.
	The declaration ends with a semicolon.<br />
  </p>
    <p>Below is an example of a system with two GAL variable declarations :</p>
	
	<?php
	printGalFile('galfiles/sample-3.gal');
	?>
	

<div class="story">	
	<h4><a name="declaration-tableaux" ></a>4.3.4 Array declarations </h4>
	<br />
	<p>An array declaration allows to declare a fixed size array of integers.  
	Like simple integer variables, each entry in the array needs to be initialized.</p>
	
    <p>A GAL array variable is declared using the keyword <span class="galElement">array</span> followed by the array size N within square brackets,
	then the array name. Each cell of the array MUST be initialized, to this end, a list of N comma separated integers surrounded by parenthesis
	(or integer expressions of constants and/or type parameters) should  be provided.
	A semicolon end the array declaration. </p>
    <p>Here is an example of a system with a declaration of an array:    </p>
	<?php
	printGalFile('galfiles/sample-4.gal');
	
	?>
</div>

<!--
<div class="story">	
	<h4><a name="declaration-listes" ></a>4.3.5  Lists declarations </h4>
	<br />
	<p>The lists provide a structure based on the principle of LIFO (Last In, First Out), i.e. a stack.
	Unlike variables and arrays, initialization of lists is not mandatory (they are then initially empty), however they can be given initial values. 
	Access to stored values in the lists is done by stacking and unstacking the top of the stack (see action on the lists) or peeking at the top value</p>
    <p>We declare a list with the keyword <span class="galElement">list</span> followed by the name of the list, and possibly followed by an equal sign
	and then a list of comma-separated values between two brackets. Like other statements, it ends with a semicolon..</p>
    <p>Below is an example of a system declaring two lists, one initialized, the other empty:</p>
	<?php
		printGalFile('galfiles/sample-5.gal');
	?>
</div>	
-->

<div class="story">
	<h4><a name="transition" ></a>4.3.6 Transitions  </h4><br />
	<p>TRansitions allow to step atomically from a source state to a (set of) successor state(s). 
	Transitions are enabled by a guard, which is a Boolean expression and may carry a label that is a string. 
	If the guard is true in the current state, the transition can be fired, executing all the actions it contains in sequence.
	Actions can be assignments, calls to a label or other statements as described below.
	Labeled actions cannot be fired if they are not called from another transiiton or synchronized externally (see ITS composite).
	Transitions without a label are "private" and can be fired any time their guard is true, with interleaving semantics.
	A self-contained GAL (not intended for further composition) typically bears no labels on transitions.
	</p>
    <p>A transition is declared with the keyword <span class="galElement">transition</span>, followed by a unique identifier for the transition.
	The transition guard (a Boolean expression) is surrounded by brackets (that can  be "true" if the transition is always enabled).
	The guard can optionally be labeled, as introduced with the keyword  <span class="galElement">label</span> followed by double quoted string defining the label. 
	Finally the statements comprising the transition body are placed in a block surrounded by curly braces.</p>
    <p>An example with two transitions of a system, the first with a label:</p>
	<?php
		printGalFile('galfiles/sample-6.gal');
	?>
</div>	

<div class="story">
	<h4><a name="expressions" ></a>4.3.7 Expressions </h4>
<p>
  GAL expressions can be either integer expressions or Boolean expressions, depending on the context.
  We give here the syntax of these expressions, which is mostly directly taken from C (or Java).
</p>

<div class="story">	
	<h5><a name="op-arith"></a> a) Integer expressions </h5>
	
	<p align="center">
		<strong>Binary</strong>	
	</p>
	<table width="200" border="1" align="center" style="border-collapse:collapse">
      <tr>
        <th scope="col">Operation</th>
        <th scope="col">Operator</th>
      </tr>
      <tr align="center">
        <td >bitwise OR</td>
        <td>|</td>
      </tr>
      <tr align="center">
        <td>bitwise XOR  </td>
        <td>^</td>
      </tr>
      <tr align="center">
        <td>bitwise AND</td>
        <td>&amp;</td>
      </tr>
      <tr align="center">
        <td>Left shift </td>
        <td>&lt;&lt;</td>
      </tr>
      <tr align="center">
        <td>Right shift </td>
        <td>&gt;&gt;</td>
      </tr>
      <tr align="center">
        <td>Addition</td>
        <td>+</td>
      </tr>
      <tr align="center">
        <td>Subtraction</td>
        <td>-</td>
      </tr>
      <tr align="center">
        <td>Multiplication</td>
        <td>*</td>
      </tr>
      <tr align="center">
        <td>Modulo</td>
        <td>%</td>
      </tr>
      <tr align="center">
        <td>Division</td>
        <td>/</td>
      </tr>
	  <tr align="center">
        <td>Power</td>
        <td>**</td>
      </tr>
    </table>
	
	
	
	<p align="center">
		<strong>Unary</strong>	
	</p>
	<table width="200" border="1" align="center" style="border-collapse:collapse">
      <tr>
        <th scope="col">Operation</th>
        <th scope="col">Operator</th>
      </tr>
      <tr align="center">
        <td >Unary minus </td>
        <td>-</td>
      </tr>
      <tr align="center">
        <td>Bitwise complement </td>
        <td>~</td>
      </tr>
    </table>
</div>


<div class="story">
	<h5><a name="expr-bool"></a>b) Boolean expressions</h5>
	<p>Boolean expressions are allowed in guards of transitions. It is also possible to write arithmetic expressions, with boolean appearance (as in C), which will be worth 1 or 0 depending on whether they are true or false (see Wrapper)</p>
    <p>The basic expressions are <span class="galElement">True</span> for &laquo;&nbsp;true&nbsp;&raquo; and <span class="galElement">False</span> for &laquo;&nbsp;false&nbsp;&raquo;. The usual boolean operators are present in GAL, such as  OR ( || ), AND ( &amp;&amp; ) and NOT( ! ). <br />
  </p>
    <p>Another case of expression is the comparison, it takes two integer expressions and compares them with the comparison operators which are:</p>
    <table width="200" border="1" style="border-collapse:collapse" align="center">
      <tr align="center">
        <th scope="col">Operation</th>
        <th scope="col">Operator</th>
      </tr>
      <tr align="center">
        <td>Greater than </td>
        <td>&gt;</td>
      </tr>
      <tr align="center">
        <td>Lower than  </td>
        <td>&lt;</td>
      </tr>
      <tr align="center">
        <td>Greater or equal </td>
        <td>&gt;=</td>
      </tr>
      <tr align="center">
        <td>Lower or equal </td>
        <td>&lt;=</td>
      </tr>
      <tr align="center">
        <td>Equals</td>
        <td>==</td>
      </tr>
      <tr align="center">
        <td>Not equal </td>
        <td>!=</td>
      </tr>
    </table>
</div>


<div class="story">
	<h5><a name="wrapper"></a>  c) Wrapper of boolean expressions </h5>
    <p>Mixing arithmetic expressions and Boolean expressions in a single arithmetic expression is possible in GAL,
	by surrounding the Boolean expression with parenthesis. In an integer 
	arithmetic context, Boolean expression true has value 1, and the false expression has value 0.
	This encapsulation of Boolean expressions as integers enables many (programming/modeling) tricks commonly encountered in C.
	</p>
    <p>
	<code>Example&nbsp;: myVariable = (a == 0) * 100&nbsp;;<i>//myVariable is 100 or 0</i></code> </p>
</div>


<div class="story">
	<h4><a name="action" ></a>4.3.8 Statements </h4>
	<p>Statements are operations that generally update the state of the system variables.
	The most common type of statement is the assignment of an integer expression on system variables to a system variable.
	Other statements include the call to a label, if-then-else conditional expressions, the abort instruction...
<!--
consisting exclusively of assignments (on variables or array elements), 
or list actions (removal or addition) on lists: <span class="galElement">pop()</span> and <span class="galElement">push()</span> (see paragraph on Actions).
-->
</p>

</div>


<div class="story">
	<h5><a name="assign"></a>  a) Assignments </h5>
    <p>Assignments are composed of a left-hand side (lhs), that must be a reference
    to a variable or to the cell of an array, and a right-hand side (rhs) that is an integer expression.
    When the lhs is a reference to an array, the target index within the array can be expressed using an arbitrarily complex 
    integer expression.
    </p>

<!--
<div class="story">
	<h5><a name="op-listes"></a>d) Operations on lists </h5>
	<p>As mentioned before, lists are based on the LIFO principle, therefore GAL provides operations for manipulating that structure. 
	Here are the operations applied on lists:</p>
	
    <p><span class="galElement">push</span>(<em>listName, integer expression </em>): can stack an integer value on the stack </p>

    <p><span class="galElement">peek(</span><em>listName</em><span class="galElement">)</span>: returns the top of the stack without extracting it.
	Invoking this operation when the list is empty is an error.</p>
    <p><span class="galElement">pop(</span><em>listName</em><span class="galElement">)</span>: same as <code>peek()</code>, only this operation
	extracts the top of the stack without returning it. </p>
    <p>Below is an example of a system that offers a small panorama of the majority of concepts related to the GAL language:</p>
    <?php
		printGalFile('galfiles/sample-7.gal');
	?>
</div>	
-->

	<p>The call action allows to call a label of the current GAL system, i.e. non-deterministically choose any of the enabled
	transitions that bear this label, and execute its actions. This powerful mechanism allows to simulate 
	some control structures. For instance, If-Then-Else(cond, actif, actelse) can be simulated by two transitions bearing label "ite",
	with guards cond and not cond respectively, and body actif and actelse respectively. Calling label "ite" in a transition
	body is like executing an if-then-else block. Note that the whole ITS semantics is defined using sets, i.e. the successor relation
	returns a set of successors. Hence if no labeled action is enabled in some states at the point of call, no successors are produced, cancelling the
	effect of the calling transition for the concerned states.
	</p>


<div class="story">	
	<h4><a name="transient" ></a>4.3.9  Transient</h4>
    <p><span class="galElement">TRANSIENT</span> 
	is a keyword that modifies the semantics of a GAL system to accelerate over states satisfying the Transient predicate.
	When the transient predicate is false (which is the default assumption if no transient predicate is provided), the basic semantics where transitions produce successors in one step is used.
	However, any state that satisfies the transient predicate will be abstracted away and replaced by its successors by any enabled transition.
	The transition relation succ becomes : ( notTransient + succ o transient ) * .		
	In other words, states satisfying the transient predicate are not considered part of the final state space, they are simply 
	intermediate steps where another transition should be fired immediately.
	A limitation of this mechanism is that cycles of transient states (zeno style behavior) are considered ill-formed, and 
	typically may cause the model-checking procedure to livelock.
	It is also an error if the initial state satisfies the transient predicate.
    </p>

    <p>The transient predicate is declared with the keyword <span class="galElement">TRANSIENT</span>, followed by the assignment sign =, followed by a Boolean expression.</p>

    <p>Here is a system that summarizes all the features of GAL:</p>
    <p>
      <?php
	printGalFile('galfiles/sample-8.gal');
	?>
</p>
</div>

<div class="story">	
	<h3><a name="fonctionnalites-editeur" ></a>4.4  GAL Editor features</h3>
	<p>The Eclipse plugin GAL inherits the editing features of the Eclipse IDE and this facilitates writing of concurrent systems.</p>
	<p><img src="images/captures/1_.png" /></p>
</div>


<div class="story">	
	<h4><a name="autocompletion" ></a>4.4.1  Auto-completion</h4>
	<p>One of the interesting features of Eclipse is the well-known auto-completion. By pressing CTRL + SPACE,  GAL provides a list of elements may complement the word according to the characters written, or otherwise the elements that can be placed where the cursor is located.</p>
	<p>Here an example of autocompletion proposed:</p>
    <p align="center">
  <img src="images/captures/autocomplete-1.png" /></p>
</div>


<!--

<div class="story">
	<h2><a name="execution-gal"></a>5. Running GAL programs </h2>
	<p>As in any imperative language, GAL comes with the ability to run, indirectly, any program you have written in GAL. You can also debug your program, for example by setting breakpoints directly into into the GAL editor, and following step by step, the transitions that will be crossed, and also the state of program variables .</p>
</div>


<div class="story">
	<h3><a name="execution"></a>5.1 Simple running into the Editor </h3>
	<p>As mentioned above, the source files in GAL must be positioned in the src folder of your project. For example in the image below, we created a program MyFirstGAL.gal</p>
	<p align="center"><img src="images/captures/galproject.png" /></p>
	<p>When the program is properly saved, the Java source files are automatically generated, to allow you to run the written GAL program. To do this, in the folder src-gen /, there are three packages:</p>
	<ul>
	  <li><strong>gal</strong> : contains the equivalent Java program to your GAL file. </li>
      <li><strong>main</strong> : contains the Java file that will run the Java version of your program. There are several strategies for program execution, that we will see in the sections below. </li>
      <li><strong>transitions.<em>NameOfYourGalSystem</em> </strong>: contains the Java classes representing the transitions written in your GAL.</li>
  </ul>
	<p>&nbsp;</p>
	<p>To &quot;run&quot; yourGAL program, run the <em>NameOfYourGALSystem</em>_Main.java, which is in package <strong>main</strong>.</p>
	<p>&nbsp;</p>
	<p><strong><em>Execution strategies of the program : </em></strong></p>
	<p>The execution of GAL program starts from an initial state, and then tries to cross transitions, depending on whether their guards are true or not. For a given state, there may be several transitions that are passable. So which transition to choose ? That is why there are several modes of GAL program execution, so the user can choose how to behave when it comes to selecting crossable transitions.</p>
	<p>There are many ways (three in total) to run a GAL program :</p>
	<ul>
	  <li><strong>The Random mode </strong> : in this mode, the program that runs, choose to cross randomly a transition, among all those which are crossable. To enable this mode, just add on the command line of the main Java file ( <em>NameOfYourGALSystem</em>_Main.java ), the option <code class="launchmode">--random</code><br />
	  &nbsp;</li>
      <li><strong>The interactive mode </strong> : mode in which the program interacts with the user, allowing him to choose (with the keyboard) a transition to cross, among all those that are passable, until there is no more crossable transitions. <br />
        Enable this mode with the option <code class="launchmode">--keyboard </code><br />
      &nbsp;</li>
      <li><strong>The Trace mode  </strong>: in this mode, you specify to the program, a trace of transitions (supposed to be passable) it must follow. The trace file is a simple text file, containing a number of transition per line. The numbers of transitions are normally ordered according to their appearance in the GAL file, and start at 0. For example if a GAL file contains, in order, transitions t1, t2, t3, then t1 will number 0,  t2 number 1, t3 number 2.<br />
        This mode is activated with the option  <code class="launchmode">--trace <em>fileOfTrace</em></code> <br />
      &nbsp;</li>
      <li><strong>The Store mode  </strong>: Is not really an execution mode, and being optional, it specifies to the program, a file name in which the execution trace traveled will be saved.<br />
      It is specified with the option <code class="launchmode">--store <em>fileOfTraceOutput</em></code></li>
  </ul>
	<p>To pass arguments to the program in Eclipse, do a right-click on the file  <em>YourGalSystem</em>_Main.java which is in the <strong>main </strong>package, then do  Run As --&gt; Run configurations...</p>
	<p>In the Arguments tab, fill in the &quot;Program arguments&quot;, the arguments you want to add on the command line of the GAL program (one of the seen above)</p>
	<p align="center"><img src="images/captures/Arguments-RunConfigurations.png" /></p>
	<p align="center">&nbsp;</p>
	<p align="center">&nbsp;</p>
</div>

<div class="story">
	<h3><a name="debug-gal"></a>5.2 Debugging in GAL </h3>
	<p>One of the interesting features of the plugin is the possibility to debug the GAL code during its execution. Thus, it becomes possible to see step by step what transition is crossed, which is not, etc. ...</p>
	<p>Here is an overview of debugging in GAL</p>
	<p align="center"><img src="images/captures/debugMyFirstGAL.png" /></p>
	<p>&nbsp;</p>
	<p>To start debugging a GAL program, do the following:</p>
	<p>- Right-click on the file  <em>YourGalSystem</em>_Main.java of  <strong>main</strong> package, then do <strong>Debug As</strong> --&gt; <strong>Java Application</strong><br />
  - You can optionally (but recommended) open the <strong>Debug</strong> perspective, by doing :  <strong>Window</strong> menu --&gt; <strong>Open perspective</strong> --&gt; <strong>Debug</strong> (or <strong>Other</strong> submenu --&gt; <strong>Debug</strong> ) </p>
	<p>It is also possible to specify arguments to the program (which are the options seen above). To do this, right-click the file  <em>YourGalSystem</em>_Main.java from the package  <strong>main</strong>, then  do <strong>Debug As</strong> --&gt; <strong>Debug configuration</strong> , then add it in the Arguments tab. </p>
</div>



<div class="story">
	<h3><a name="api-gal"></a>5.3 GAL API  </h3>
  <p>By default in the plugin, the main program and several other files (classes of transitions, Java class representing the GAL system) are automatically generated each time you save a GAL file, and are located in src-gen/ folder. But it is also possible to create your own Java files to manipulate the system. Thus, you will be able to customize the execution of GAL to your liking, by creating for example your own &quot;main&quot; file.</p>
	<p>However, keep in mind that in order to manipulate a GAL, you must have an instance of this system. For example:</p>
	<pre><code>
	IGAL mySystem = <span class="galElement">new</span> <em>Name_of_your_GAL_system</em>() ; 
	</code></pre>
	<p class="galInterfaceTitle">IGAL </p>
	<p>IGAL is the interface that describes a GAL system, and everything in it. When you write a GAL file, by default a Java file that implements this interface is automatically generated, in src-gen/gal/<em style="color:#990000">YourGALSystem</em>.java </p>
	<p><strong>Methods of IGAL </strong></p>
	
	
	<table width="688" border="1"  style="border-collapse:collapse;" >
      <tr valign="top" >
        <th width="108" scope="col">Return value </th>
        <th width="564" scope="col">Method name  </th>
      </tr>
      <tr valign="top">
        <td valign="top" ><code>String</code></td>
        <td valign="top"><code>getName()</code><br /><br />
        <span class="codeDescription">Returns the name of the GAL system. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>[IState](#desc-istate)</code></td>
        <td valign="top"><code>getInitState()</code> <br />
        <br />
		<span class="codeDescription"> Returns the initial state of the system. 	 The initial state contains all variables and their values assigned at initialization.</span></td>
      </tr>
      <tr>
        <td valign="top"><code>List&lt;[ITransition](#desc-itransition)&gt;</code></td>
        <td valign="top"><code>getTransitions() </code><br />
        <br />
		<span class="codeDescription">Returns the list of all transitions of the GAL system</span>		</td>
      </tr>
	  
	   <tr>
        <td valign="top"><code>boolean</code></td>
        <td valign="top"><code>getTransient([IState](#desc-istate) entryState) </code><br />
        <br />
		<span class="codeDescription">Returns the boolean value of the TRANSIENT statement. <code>entryState</code> is the state in which variables values will be retrieved</span>		</td>
      </tr>
    </table>
	<p>&nbsp;</p>
	<p class="galInterfaceTitle"><a name="desc-itransition"></a>ITransition</p>
	<p>This interface represent a transition in a GAL system.</p>
	<p><strong>Methods of ITransition </strong></p>
	<table width="688" border="1"  style="border-collapse:collapse;" >
      <tr valign="top" >
        <th width="108" scope="col">Return value </th>
        <th width="564" scope="col">Method name </th>
      </tr>
      <tr valign="top">
        <td valign="top" ><code>String</code></td>
        <td valign="top"><code>getName()</code><br />
            <br />
            <span class="codeDescription">Returns the name of the transition. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>boolean</code></td>
        <td valign="top"><code>guard([IState](#desc-istate) entryState)</code> <br />
            <br />
        <span class="codeDescription"> Returns the boolean value of a transition guard.. <code>entryState</code> is the state in which variables values will be retrieved. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>IState</code></td>
        <td valign="top"><code>successor([IState](#desc-istate) entryState) </code><br />
            <br />
        <span class="codeDescription">Evaluate the body of the transition, and returns a state in which variables have been 	  modified.. <code>entryState</code> is </span> the state in which variables values will be retrived</td>
      </tr>
      
    </table>
	<p class="galInterfaceTitle"><a name="desc-istate"></a>IState</p>
	<p>This interface represents a &quot;state&quot; in a GAL system.  A state can be seen as a great set, which contains lists, integers variables, and arrays,    and their associated values, at a precise time.</p>
	<p><strong>Methods of IState </strong></p>
	<table width="688" border="1"  style="border-collapse:collapse;" >
      <tr valign="top" >
        <th width="108" scope="col">Return value </th>
        <th width="564" scope="col">Method name </th>
      </tr>
      <tr valign="top">
        <td valign="top" ><code>int</code></td>
        <td valign="top"><code>getNumberOfVariables()</code><br />
            <br />
            <span class="codeDescription"> Returns the number of variables in the system. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>int</code></td>
        <td valign="top"><code>getNumberOfArrays() </code> <br />
            <br />
            <span class="codeDescription"> Returns the number of arrays in the system. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>int</code></td>
        <td valign="top"><code>getNumberOfLists() </code><br />
          <br />
        <span class="codeDescription">Returns the number of lists in the system</span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>addVariable(String varName, Integer value) </code><br />
          <br />
			<span class="codeDescription">Add a variable in the state.</span>        <br />
			<strong>varName</strong> : The name of the new variable<br />
			<strong>value</strong> :   Value of this new variable</td>
      </tr>
	   <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>setVariable(String varName, Integer value) </code><br />
          <br />
			<span class="codeDescription">Sets a value to an existing variable.</span></td>
      </tr>
	  
	   <tr>
        <td valign="top"><code>Integer</code></td>
        <td valign="top"><code>getVariable(String varName) </code><br />
          <br />
			<span class="codeDescription">Returns the value of a variable</span></td>
      </tr>
	  
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>createArray(String arrayName, List&lt;Integer&gt;initValues)</code><br />
          <br />
          <span class="codeDescription">Create an array, initialized with each elements of a list of integers. </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>setValueInArray(String arrayName, int indexOfValue, Integer value)<br />
          <br />
</code>
        <span class="codeDescription">Sets a <em>value</em> to an array element, which is at position <em>indexOfValue</em> in the array <em>arrayName</em>.</span></td>
      </tr>
      <tr>
        <td valign="top"><code>Integer</code></td>
        <td valign="top"><code>getValueInArray(String arrayName, int indexOfValue)<br />
          <br />
</code>
          <span class="codeDescription"></span>Returns the value of an array element</td>
      </tr>
      <tr>
        <td valign="top"><code>int</code></td>
        <td valign="top"><code>getSizeOfArray(String arrayName)<br />
          <br />
</code>
        <span class="codeDescription">Return the size of the array  <em>arrayName</em> </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>createList(String listName, List&lt;Integer&gt; initValues)<br />
          <br />
</code>
        <span class="codeDescription">Create a list, initialized with each elements of the list </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>popInList(String listName)<br />
          <br />
        </code>
        <span class="codeDescription">Remove the first element of the list  <em>listName</em> </span></td>
      </tr>
      <tr>
        <td valign="top"><code>Integer</code></td>
        <td valign="top"><code>peekInList(String listName) </code> <br />
          <br />
        <span class="codeDescription">Returns the first element of a list, without removing it </span></td>
      </tr>
      <tr>
        <td valign="top"><code>void</code></td>
        <td valign="top"><code>pushInList(String listName, Integer valueToPush)<br />
          <br />
</code>
          <span class="codeDescription">Push an integer to a list </span></td>
      </tr>
      <tr>
        <td valign="top"><code>Integer</code></td>
        <td valign="top"><code>getValueInList(String listName, int indexOfValue)<br />
          <br />
</code>
        <span class="codeDescription">Returns the value at position <em>indexOfValue</em> in the list </span></td>
      </tr>
      <tr>
        <td valign="top"><code>int </code></td>
        <td valign="top"><code>getSizeOfList(String listName)<br />
          <br />
</code>
        <span class="codeDescription">Returns the size of the list </span></td>
      </tr>
      <tr>
        <td valign="top"><code>Object</code></td>
        <td valign="top"><code>clone()</code><br />
          <br />
        <span class="codeDescription">Clone the list. </span></td>
      </tr>
    </table>
	<p>&nbsp; </p>
</div>

-->

    <h2><a name="introduction"></a>Credits</h2>
    <p>This project was developed as part of the M1 student project and subsequent internship of KOUADIO Yao Louis St�phane Armel, SELLOU Hakim and
ABKA Faycal, made in the MoVe team (Modeling and Verification) of Laboratory of Computer Science at the University Pierre et Marie Curie (LIP6), in the year 2012, under the supervision of Yann Thierry-Mieg. The aim of the internship was to implement an Eclipse plugin that allows editing of GAL files. This plugin harnesses all the power of Eclipse, including auto-completion, or quick-fix.</p>
    <p>To achieve the goals, we used Eclipse and Xtext (<a href="http://www.eclipse.org/Xtext/" target="_blank">http://www.eclipse.org/Xtext/</a>), an Eclipse plugin that allows you to define grammars for languages dedicated to a specific domain (<strong>D</strong>omain <strong>S</strong>pecific <strong>L</strong>anguage) in all its aspects, and this in a comprehensive manner.</p>
    <p>The GAL plugin was developed using collaborative development tools, such as SVN for version control (public depot available with login/pass "anonymous/anonymous" at <a href="https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL" target="_blank">svn co https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL</a>), as well as a server for continuous integration ([TeamCity](http://teamcity-systeme.lip6.fr/)).</p>


