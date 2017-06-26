# Using ITS to build and analyze DVE specifications.

ITS-tools is happy to offer support for DVE the original modeling language of Divine. We provide an Xtext based editor (content-assist, correct as you type...) to edit .dve files and transformation(s) to GAL for analysis.


## <a name="sec:Install"></a>I. Install

Please follow [these guidelines](itstools.md#sec:modinst) to install ITS modeler.

You should now be able to open a .dve file within Eclipse, let it add "Xtext nature" to your project to enable the full featured editor.

## <a name="sec:DVEeditor"></a>II. Using the DVE editor

### <a name="ssec:modelDVE"></a>1\. Modeling with DVE

In an empty project create or import an existing dve file to get started. The syntax is explained on the webpage : [DVE description from Divine home page](http://divine.fi.muni.cz/manual.html#the-dve-specification-language)

You can also use "File->New->Example...->Coloane Examples->DVE examples" to get a project containing a few tested examples from BEEM benchmark models.

You can use Ctrl-space to trigger auto-completion, ... In essence it's just a nice Eclipse look-n-feel coloring editor.


### <a name="ssec:importDVE"></a>2\. Reading DVE into GAL

Analysis is performed by first translating the model to [GAL](gal.md). The actual transformation is described here : [DVE translation (pdf)](./files/xta-bench.pdf).

1.  Right click the dve file in Eclipse, then select action "DVE to GAL -> Transform to GAL". You can also select a set of files or a folder it will recursively find .dve files.
2.  You will obtain two GAL image files for each input dve file. One of them contains the translation result, with extension .gal, the other is the simplified model .flat.gal you should actually use for verification.

The translation builds GAL variables for DVE global variables, a variable holding the state of each process, a variable corresponding to each process local variable. The variables corresponding to process states have an integer domain : we use indexes to the state declarations in the DVE specification (in the same order, starting from 0).

For channels, two cases are possible : if data is transmitted in the channel a crossproduct of all sender to receiver combinations is built, otherwise a pure label based synchronization scheme is used. Due to limits on GAL parameter declarations, for which domains must be a priori known, data transmission cannot be encoded directly using labels in GAL when message domain is unknown a priori.

Transitions are transformed to GAL transitions in a direct manner (DVE guard to GAL guard, DVE effects to GAL transition body), with labels corresponding to pure synchronizations on channels if appropriate.

As an additional feature, states named "trans_" are abstracted away from the state space, using GAL "transient" predicate mechanism. Any global system state in which any process is in a transient state (i.e. whose name starts with string "trans_") is abstracted away in the final state graph (we skip directly to successors of such states).

Note that in the flat model, variables that are in fact constants will be removed, up to and including the process state variable when the process has a single state.

The translation for DVE is actually also implemented within the command-line its-tools, with flag "-t DVE" they will accept DVE files natively. The more recent translation path using metamodels and embedded in Eclipse includes much more error checking, e.g. raising errors on inconsistent examples of the BEEM benchmark. It also exploits GAL to GAL rewritings that may simplify significantly the model prior to analysis. The command-line DVE input to its-tools however includes some support for native DVE logic (e.g. Proc.state is an atomic proposition asserting that process Proc is in state "state"). The translation also differs in several small respects, e.g. the eclipse embedded version includes readable comments and significant transition names in the output (libits just numbers transitions making traceability an issue).

A third path is open to read DVE models through LTSmin ETF format. For this you need to run LTSmin dve2etf tool then use flag "-t ETF" to pass the file to its-tools. When this succeeds (i.e. LTSMin manages to build the state space) subsequent model-checking using the ETF input tends to be faster than using the original DVE input. Note that its-reach is known to succeed using DVE input for many models where LTSmin fails (mostly in presence of synchronization barriers that impact a lorge number of variables in their support). This path through ETF is mandatory to activate TGTA (testing automata) approaches for LTL (see its-ltl command line options and Tacas'14 paper).

Mail us ddd@lip6.fr if you have any feature requests or bugs to report on this DVE module.

## <a name="sec:bench"></a>3\. Experiments with DVE models

We have run some benchmark experiments to measure how its-tools handles models from the BEEM benchmarks.

Details on LTL experiments are available here : [LTL benchmarks](ltl_bench.md).

Experiments comparing ITS-tools to SuperProve and LTSmin are reported here : [CAV 2013 paper.](./files/mlhom.pdf)

Note that on most models of the BEEM benchmark, the number of states remains relatively low (thousands to millions of states), and explicit model-checkers often outperform symbolic approaches quite handily.

## <a name="sec:Ack"></a>Acknowledgements

The various plugins, the definition of a DVE metamodel and the implementation of the transformation embedded in eclipse were initiated by Master 1 students of UPMC (2014): Sarah Dahab, Mokrane Kadri and Tahar Ouazib under supervision of Yann Thierry-Mieg ([see PSTL report in french (pdf)](./files/PSTL_dve.pdf)). Integration and maintenance is done by Yann Thierry-Mieg.

The transformation built into libits uses some source code of Divine 2 (grammar, basic parser data structures), coming from versions patched by LTSmin team for parsing of the DVE model (see libits acknowledgements section). The transformation itself was written by Yann Thierry-Mieg and Maximilien Colange.