# Using ITS to build and analyze Timed Automata.

ITS-tools is happy to offer support for Timed Automata, in a discrete time setting. Alpha-Stage Warning : this tool is still very young, and may exhibit strange features (read bugs). Some effort has been invested in providing compatibility with the reference Timed Automata tool [Uppaal](http://www.uppaal.org) and providing a decent editing front-end. The plugin offers an Xtext based editor (content-assist, correct as you type...) to edit .xta files which is [the textual syntax of Uppaal v4](http://www.it.uu.se/research/group/darts/uppaal/help.md?file=FileFormats.shtml).

<a name="toc"></a>

## <a name="sec:Install"></a>I. Install

Please follow [these guidelines](eclipsestart.md) to install ITS modeler.

To obtain an .xta file from Uppaal choose "File... Save As" then give the file a .xta extension.

Please note that this is a very early alpha-release, we appreciate your feedback. We did manage to read in all the models included in Uppaal distribution so there is tested support for variables, templates, template parameters, instantiation, local clocks, locations, transitions, arithmetic, urgent locations, and location invariants. This version currently does not support Function declarations or array variables. There are known issues with global clocks and with commit states currently.

## <a name="sec:TPNeditor"></a>II. Using the XTA editor

### <a name="ssec:modelTPN"></a>1\. Modeling with Discrete Timed Automata

In an empty project create or import an existing xta file to get started. The syntax is explained in summarized in the BNF [here](http://people.cs.aau.dk/~adavid/utap/syntax.html) and explained in much more detailed form in [the reference manual](http://www.it.uu.se/research/group/darts/uppaal/help.md?file=System_Descriptions/Model.shtml").

You can also use "File->New->Example...->Coloane Examples->Timed Automata" to get a project containing a few tested examples from Uppaal distribution.

You can use Ctrl-space to trigger auto-completion, ... In essence it's just a nice Eclipse look-n-feel coloring editor.

Note that the interpretation (semantics) will be in discrete time instead of Uppaal's dense time hypothesis. So keep in mind that x < k will be interpreted as x ≤ k-1.

In general, it is preferable to use only open bounds (always use ≤ and ≥ rather than < and >). If this condition is respected, analysis in discrete and dense time settings coincide; hence you are guarantedd to get the same analysis results as with Uppaal.

Note that for most models the fact we are using a discrete time setting for analysis is not really significant with regards to analysis results.

<div class="toplink" align="right">[Start of page ![](images/up.gif)](#toc)</div>

### <a name="ssec:importTA"></a>2\. Reading Timed Automata into GAL

Analysis is performed by first translating the model to [GAL](gal.md). The actual transformation is described here : [Experiments with XTA (pdf)](./files/xta-bench.pdf).

1.  Right click the xta file in Eclipse, then select action "TA to GAL -> Transform to GAL" either Essential States or One-step. You can also select a set of files or a folder it will recursively find .xta files.
2.  You will obtain two GAL image files for each input xta file. One of them contains the translation result, with extension .pop if it uses essential states semantics, and .one if it uses one time step semantics. The file with extension .flat.gal is a simplified output from the GAL post-analysis rewritings, that can be passed with flag "-t GAL" to command line its-tools.

## <a name="sec:bench"></a>3\. Experiments with Timed Automata

We have run some benchmark experiments to measure how its-reach scales with respect to Uppaal on some of these Timed Automata models. Overall, Uppaal is much more resistant to high clock limit values, but its-reach supports much higher number of concurrent processes provided maximum clock values remain small.

The results of these experiments are reported here : [Experiments with XTA (pdf)](./files/xta-bench.pdf). The rest of this section is technical instructions allowing to reproduce our experiments.

The benchmark constitutes in 3 models declined with various number of process, and various clock bound settings. In total there are 265 XTA model instances and 530 GAL model instances (one with One-step and one with Essential States semantics).

The models are taken from [Uppaal benchmark suite](www.it.uu.se/research/group/darts/uppaal/benchmarks/) :

1.  FDDI token ring protocol : (folder hddi) we have three parameters, i number of process, j a multiplier, k a constant. We use definitions : [SA=k, TRTT=(K+i*j)](https://srcdev.lip6.fr/trac/research/thierry/browser/PSTL/GAL/fr.lip6.move.xta.benchmarks/hddi/tokenring.gen.awk). We use sample values : i in "02 03 05 07 10 15 20 25 30", j in "1 2 5 10 20", k in "0 1 10 50".
2.  Fischer mutual exclusion : (folder fischer) we have two parameters, i the number of process, and K the bound on clocks. We use sample values : i in "02 03 05 07 10 15 20 25 30 50", K in "02 04 08 16"
3.  CSMA CD Collision Detection : we have two parameters, i the number of process and C the clock definition values. We use : (C == 1) SA = 1, SB = 2, TRTT = 3; (C == 2) SA = 2, SB = 4, TRTT = 8; (C == 3) SA = 13, SB = 26, TRTT = 55; (C == 4) SA = 26, SB = 52, TRTT = 808; Sample values are : i in "02 03 05 07 10 15 20 25 30", C in "1 2 3 4 5".

To reproduce these experiments, you can checkout this project :  
"svn co https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL/fr.lip6.move.xta.benchmarks", using anonymous/anonymous as login/password pair.

##### Generating the benchmark example files.

You will need

*   a bash environment including make, awk, perl.
*   An eclipse [ITS Modeler front-end](eclipsestart.md) deployed, since we currently lack command-line version of the transformation tool.

Once you have these elements,

1.  Run "make gen", this should produce a (large) set of *.xta files.
2.  To produce the GAL files, we now need to run Eclipse, then select "File->Import->Existing Projects into Workspace" and point it to the root folder you checked out earlier.
3.  In the project obtained, select the root folder then "right-click->TA to GAL->Transform to GAL (Essential States)". This will recursively apply the transformation to all ".xta" files in subfolders. The transformation is quite long due to the high number of files (and there is no progress monitor, sorry), please be patient (or do it separately for each folder).
4.  Rinse and repeat : also select translation "Transform to GAL (Time unit Step)"
5.  Make sure you have indeed built "*.one.flat.gal" (one unit time step) and "*.pop.flat.gal" (Popova's Essential States semantics). You can then quit Eclipse.

##### Analyzing the benchmark example files.

You will need :

*   a compiled distribution of Uppaal (we used the latest 4.1.16).
*   a compiled distribution of Memtime (we used [this version.](http://tiger.cs.tsinghua.edu.cn/Students/yangjl/memtime/)
*   the [command-line distribution of its-tools](http://move.lip6.fr/software/DDD/itstools.md#sec:cldl) (only its-reach really used)

Once you have these elements,

1.  Edit the top of the Makefile (at the root of the checkout folder) to point to your binaries. You can also set higher or smaller timeout and out of memory thresholds.
2.  Run "make perfs", be prepared to wait for a while (several hours total with default 10 minute timeout).
3.  You should now have files titled "trace.out" and "upptrace.out" in each of the example folders, containing raw traces from the tools.
4.  Run "make trace.csv" to have the perl scripts post-analyze the traces to grab relevant info (detect successful runs, timeouts, out of memory, and grab memory and time stats). You will obtain a trace.csv file.
5.  Open and examine the CSV file using your favorite spreadsheet editor. Running "make stats" will show general stats. Running "make plots" will build graphical scatter plots (eps files) comparing the techniques.

## <a name="sec:Ack"></a>Acknowledgements

The various plugins and the definition of an XTA metamodel were done by Yann Thierry-Mieg. The transformation was built by Yann Thierry-Mieg and Maximilien Colange.