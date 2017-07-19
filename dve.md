# Using ITS to build and analyze DVE specifications.

ITS-tools is happy to offer support for DVE the original modeling language of Divine. 
We provide an Xtext based editor (content-assist, correct as you type...) to edit .dve files and transformation(s) to GAL for analysis.


## Install

Please follow [these guidelines](eclipsestart.md) to install ITS modeler.

You should now be able to open a .dve file within Eclipse, let it add "Xtext nature" to your project to enable the full featured editor.

## Using the DVE editor

### Modeling with DVE

In an empty project create or import an existing dve file to get started. 
The syntax is explained on the webpage : [DVE description from Divine home page](https://paradise.fi.muni.cz/~xstill/darcs/divine31a/gui/help/divine/language.html)

You can also use "File->New->Example...->Coloane Examples->DVE examples" to get a project containing a few tested examples from BEEM benchmark models.

You can use Ctrl-space to trigger auto-completion, ... In essence it's just a nice Eclipse look-n-feel coloring editor.


### DVE to GAL translation

Analysis is performed by first translating the model to [GAL](gal.md). The actual transformation is succinctly described here : [CAV'13](https://pagesperso.lip6.fr/Fabrice.Kordon/pdf/2013-CAV+annex.pdf).

1.  Right click the dve file in Eclipse, then select action "DVE to GAL -> Transform to GAL". You can also select a set of files or a folder it will recursively find .dve files.
2.  You will obtain two GAL image files for each input dve file. One of them contains the translation result, with extension .gal, the other is the simplified model .flat.gal you should actually use for verification.

The translation builds GAL variables for DVE global variables, a variable holding the state of each process, a variable corresponding to each process local variable. 
The variables corresponding to process states have an integer domain : we use indexes to the state declarations in the DVE specification (in the same order, starting from 0).

For channels, two cases are possible : if data is transmitted in the channel a cross-product of all sender to receiver combinations is built,
 otherwise a pure label based synchronization scheme is used. 
 
Due to limits on GAL parameter declarations, for which domains must be a priori known, data transmission cannot be encoded directly using labels in GAL when message domain is unknown a priori.

Transitions are transformed to GAL transitions in a direct manner (DVE guard to GAL guard, DVE effects to GAL transition body), 
with labels corresponding to pure synchronizations on channels if appropriate.

As an additional feature, states named "trans_" are abstracted away from the state space, using GAL "transient" predicate mechanism. 
Any global system state in which any process is in a transient state (i.e. whose name starts with string "trans_") is abstracted away in the final state graph (we skip directly to successors of such states).

Note that in the flat model, variables that are in fact constants will be removed, up to and including the process state variable when the process has a single state.

### Running the transformation

There are three ways to model-check DVE models with the ITS-tools :
* The more recent translation path is built using metamodels and embedded in Eclipse.
It includes some nice error checking, e.g. raising errors on inconsistent examples of the BEEM benchmark. 
It also exploits GAL to GAL rewritings that may simplify significantly the model prior to analysis. This is the currently recommended approach.
	* Right click a DVE file in eclipse, then find the "DVE to GAL -> Transform to GAL" menu entry. Make sure to refresh the containing folder (F5) so that you see the resulting file in eclipse.
* The command-line its-tools (its-reach, its-ctl, its-ltl) accept DVE models natively with flag "-t DVE". 
Internally a translation to GAL is performed, run without "--quiet" flag to see the resulting model.
Direct DVE input to its-tools includes some support for native DVE logic (e.g. Proc.state is an atomic proposition asserting that process Proc is in state "state"). 
The translation also differs in several small respects with the Eclipse translation, e.g. naming of object.
	* Run the command line its-tools with "-i mymodel.dve -t DVE"
* A third path is open to read DVE models through LTSmin ETF format. ETF is relatively compact representation of the state graph that LTSmin can build.
When this succeeds (i.e. LTSMin manages to build the state space) subsequent model-checking using the ETF input tends to be faster than using the original DVE input. 
Note that its-reach is known to succeed using DVE input for many models where LTSmin fails (mostly in presence of synchronization barriers that impact a large number of variables in their support). 
	* First run [LTSmin **dve2lts-sym** tool](http://fmt.cs.utwente.nl/tools/ltsmin/doc/dve2lts-sym.html) to build an ETF, then use flag "-t ETF" to pass the file to its-tools. 
	* This path through ETF is mandatory to activate TGTA (testing automata) approaches for LTL (see [LTSmin bridges](ltsmin.md) page).
	
Mail us ddd@lip6.fr if you have any feature requests or bugs to report on this DVE module.

## Experiments with DVE models

We have run some benchmark experiments to measure how its-tools handles models from the BEEM benchmarks.

Details on LTL experiments are available here : [LTL benchmarks](ltl_bench.md).

Experiments comparing ITS-tools to SuperProve and LTSmin are reported here : [CAV 2013 paper.](./files/mlhom.pdf)

Note that on most models of the BEEM benchmark, the number of states remains relatively low (thousands to millions of states), and explicit model-checkers often outperform symbolic approaches quite handily.

## Acknowledgements

The various plugins, the definition of a DVE metamodel and the implementation of the transformation embedded in eclipse were initiated by Master 1 students of UPMC (2014): Sarah Dahab, Mokrane Kadri and Tahar Ouazib under supervision of Yann Thierry-Mieg ([see PSTL report in french (pdf)](./files/PSTL_dve.pdf)). 
Integration and maintenance is done by Yann Thierry-Mieg.

The transformation built into libits uses some source code of Divine 2 (grammar, basic parser data structures),
 coming from versions patched by LTSmin team for parsing of the DVE model (see [libits acknowledgements](libits.md#acknowledgements)). 
 It was written by Yann Thierry-Mieg and Maximilien Colange.