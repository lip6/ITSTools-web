# Promela specifications.

ITS-tools is happy to offer support for (a subset of) Promela the original modeling language of Spin. 

We provide an Xtext based editor (content-assist, correct as you type...) to edit .dve files and transformation(s) to GAL for analysis.

## Install

Please follow [these guidelines](eclipsestart.md) to install ITS modeler.

You should now be able to open a .pml file within Eclipse, let it add "Xtext nature" to your project to enable the full featured editor.

## Using the Promela editor

### Modeling with Promela

In an empty project create or import an existing dve file to get started. The syntax is explained on the webpage : [Promela description from Spin homepage](http://spinroot.com)

You can also use "File->New->Example...->Coloane Examples->Promela examples" to get a project containing a few tested examples from BEEM benchmark models.

You can use Ctrl-space to trigger auto-completion, ... In essence it's just a nice Eclipse look-n-feel coloring editor.

### Reading Promela into GAL

Analysis is performed by first translating the model to [GAL](gal.md). The actual transformation is described here : [Promela translation (french pdf)](./files/PSTL_promela.pdf).

1.  Right click the .pml file in Eclipse, then select action "Promela to GAL -> Transform to GAL". You can also select a set of files or a folder it will recursively find .pml files.
2.  You will obtain two GAL image files for each input pml file. One of them contains the translation result, with extension .gal, the other is the simplified model .flat.gal you should actually use for verification.

The editor only recognizes files with ".pml" extension.

## Experiments with Promela models

We have run some benchmark experiments to measure how its-tools handles models from the BEEM benchmarks. 
The models of BEEM in promela format were successfully read and yielded the correct number of states (i.e. the same as reported by Spin with partial order deactivated).

This set of models is quite limited in the number of concepts and the portion of the syntax of Promela that is covered however.

## Acknowledgements

The various plugins, the definition of an Promela metamodel and the implementation of the transformation embedded in eclipse were done by Master 1 students of UPMC (2014) : Adrien Becchis, Fjorilda Gjermizi and Julia Wisniewsky under supervision of Yann Thierry-Mieg ([see PSTL report in french (pdf)](./files/PSTL_promela.pdf)). 

Integration and maintenance is done by Yann Thierry-Mieg.