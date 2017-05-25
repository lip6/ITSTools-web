

<html>
<?php include 'header.md'; ?>

<h1> Guarded Action Language Meta-model and grammar documentation </h1>
<style type="text/css">
<!--
.galElement {
	font-family:Monospace,"Courier New", Courier;
	font-weight:bold;
	color:red
	
}
-->
</style>

    <h1>GAL Metamodels</h1>
    <p>GAL is a DSL meant to express model semantics. As such it is meant to be the target of a model transformation process.</p>
	<p>This page gives the technical details : it explains the concrete syntax (using an Xtext grammar) and the abstract syntax (using a meta-model). </p>
    <p><strong>Contents</strong></p>
    <div id="sommaire">
	
	<?php
	TableOfContents(__FILE__, 5); 
	?>
	
	
	</span>
  
<h2><a name="sec:Install"></a>1. Install </h2>

<p>For a developer, it is recommended to set up your eclipse as indicated [in the developer corner](download.md) of the download page.</p>

<p>The fr.lip6.move.gal package hosts the full Xtext grammar (or you can <a href="http://projets-systeme.lip6.fr/trac/research/thierry/PSTL/GAL/fr.lip6.move.gal/src/fr/lip6/move/gal">>browse it here</a) </p>
<p> After executing the MWE2 workflow, the ecore metamodel is found in model/generated folder. The model folder contains a .aird file that hosts the diagrams presented in this page. You can open them natively using the EcoreTools plugin from standard eclipse download site.</p>

 <p><h2><a name="overview"></a>2. GAL overview </h2></p>
   
   This page presents the concrete and abstract syntax of GAL, please read [this document](./files/gal.pdf) for a more formal overview of GAL
   semantics and some of their applications.

   	<h3><a name="terminals"></a>2.0 Lexer Terminals </h3>
   
   <p>These are the terminal lexer tokens of GAL. 
   ID is an Xtext predefined terminal that matches C identifiers.
   Many of our names support '.' in their definition, to help trace flattening 
   of composite types to plain GAL. Parameters (which are runtime constants) are 
   identified by a dollar sign. The its-tools command line parser cannot parse 
   all of this grammar, many concepts (such as parameters) are simplified out before invoking the its-tools.
    </p>
    <?php 
		highlight_file("metamodel/terminals.xtex");
	?>
	
   
   
	<h3><a name="specification"></a>2.1 Specification </h3>
	
	<img src="metamodel/specification.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/specification.xtex");
	?>
	
	
	<p>A Specification is the root of a gal model. It holds types, of which one is the main, and properties. 
	It can also define constant parameters (symbolic constants) and ranges, in any order. Interfaces are used in the 
	template parameter type system.</p>
	

  
	<h3><a name="gal"></a>2.2 GAL type declaration </h3>

	<img src="metamodel/gal.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/gal.xtex");
	?>
	
	
	<p>A GALTypeDeclaration mainly holds variables and arrays, and transitions. 
	It can also define type parameters (that can be fixed at instantiation) as well as local range types.
	Predicates can be referred to by logic properties.
	</p>
	

	<h3><a name="intexpressions"></a>2.3 Integer Expressions </h3>
	<img src="metamodel/intexpressions.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/intexpressions.xtex");
	?>

	
	<h3><a name="boolexpressions"></a>2.4 Boolean Expressions </h3>
	<img src="metamodel/boolexpression.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/boolexpressions.xtex");
	?>

	<h3><a name="composite"></a>2.5 Composite type declaration </h3>
	<img src="metamodel/composite.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/composite.xtex");
	?>
	
	
	<h3><a name="nameddecl"></a>2.6 Named declaration </h3>
	<img src="metamodel/namedDeclaration.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/nameddecl.xtex");
	?>
	
	<h3><a name="refs"></a>2.7 References </h3>
	<img src="metamodel/reference.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/reference.xtex");
	?>

		<h3><a name="statement"></a>2.8 Statements </h3>
	<img src="metamodel/Statement.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/statement.xtex");
	?>
	
	<h3><a name="params"></a>2.9 Parameters </h3>
	<img src="metamodel/parameters.jpg" alt="download" />
    <?php 
		highlight_file("metamodel/parameters.xtex");
	?>
	
	
	
    <h2><a name="credits"></a>Acknowledgements</h2>
    <p>The GAL metamodel, xtext grammar, and this page are the work of Yann Thierry-Mieg.
    The initial metamodel/grammar of GAL was built during the internship (Master 1 2011) of KOUADIO Stephane, SELLOU Hakim and
ABKA Faycal. Initial version of composite metamodel/grammar was built during internship (Master 1 2012) of CANTAIS Alexis and TRAN Marie-Diana.
    </p>


<!-- #EndEditable -->
<?php include 'footer.md'; ?>

</html>
