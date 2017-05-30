---
title: Getting Started with ITS-tools
---

Download ITS-tools
==================

Requirements :
* [Java 8](http://www.oracle.com/technetwork/java/javase/downloads/index.html) standard edition (SE)

For quick install into eclipse use the update site **https://lip6.github.io/ITSTools/** to install the _All-In-One_ feature. 

Step 1 :Install eclipse.
------------------------ 

You can skip this step if you have a recent eclipse (Luna or better), otherwise get the "Eclipse IDE for Java Developers" it's one of the smaller distributions.

[Download the latest version of Eclipse](http://www.eclipse.org/downloads/) for your platform and install it. 
We recommend you go for an archived release (tgz or zip) rather than automatic installer.

**Download the archive, decompress it, and run eclipse.**

The back-end model-checking tools are fully integrated in the installer for all major platforms 
(Mac OS, Windows or Linux and x64 architecture). 

#### (optional) GraphViz

Users of GAL and textual formalisms can skip this step.

This package is optional, but really helps when manipulating large graphical models such as Petri nets. It allows to layout large graphs.
	
If you don't already have [graphviz, download it.](http://www.graphviz.org/Download.php).
It is sometimes already available (linux, MacOS), try the command "dot" at a command line to check.

Step 2 : Eclipse integration with ITS tools.
--------------------------------------------

**NEW (May 2017): Our update site has moved to GitHub ! Update your update site address to 'https://lip6.github.io/ITSTools/'**

Start Eclipse. To deploy the user interface plugin into eclipse, go into the menu : "Help->Install New Software..."

In the "Work with" field, copy paste the following update site address :<url>https://lip6.github.io/ITSTools/</url>

Then select like on this screenshot
<img src="images/update.jpg" alt="download" />

The first category allows to install all the features with a single selection. If you are only interested in some packages, the third category allows to pick and choose what will be installed. 

Leave the "Contact all update sites" checkbox marked so necessary dependencies (Xtext if not yet installed) will be downloaded automatically from the eclipse releases official update site. 
Please be a bit patient, eclipse updates are pretty slow. Let eclipse restart when the installation finishes.

If you later want to update, the checkbox "contact all" can be left unchecked, this speeds install considerably.

## Acknowledgements : Companies helping us deliver quality Open-source

**Hosting**

<img src="images/GitHub_Logo.png" height="50" />
* We are grateful to [GitHub](https://github.org/) for hosting us and for all the great support it offers to develop collaborative large open source software.

**Profiler**

<img src="https://www.ej-technologies.com/images/product_banners/jprofiler_large.png" height="50" />

* [JProfiler](https://www.ej-technologies.com/products/jprofiler/overview.html) helps us track down and remove performance bottlenecks in our Java code. 
With ergonomic access to "allocation hot spot" and "call hot spot", easy attach to running JVM, custom filtering, this tool has all you need to professionally optimize code. 
With their open-source friendly license policy, they helped us gain orders of magnitude in performance on many test cases.

**Continous Integration servers**

<img src="https://cdn.travis-ci.com/images/logos/TravisCI-Full-Color-45e242791b7752b745a7ae53f265acd4.png" height="50" />
* We are grateful to [travis-ci](https://travis-ci.org/) for their open-source project support policy, that allows us to use their public
continuous integration technology in the cloud to build Java/Maven, Linux and OSX artifacts.

<img src="images/appveyor.png" height="50" />
* We are grateful to [AppVeyor](https://www.appveyor.com/) for their open-source project support policy, that allows us to use their public
continuous integration technology to build and distribute Windows targets.

<img src="images/logo_teamcity.jpg" height="50" />
* We are still grateful to [JetBrains](http://www.jetbrains.com) and their open-source project support policy, that allowed us to use their excellent
continuous integration server technology [TeamCity](http://www.jetbrains.com/teamcity/) from 2008 to 2016. 

#### (optional) Configure Eclipse to use GraphViz

<p>This step allows to activate the layout tool, to automatically
	set positions of Petri net nodes or other graphs. This step is only necessary if "dot"
	at a command line does not work, i.e. "dot" is not on the PATH.</p>
<p>Inside eclipse, go to "Window Menu->Preferences" then open the
	category "Coloane -> Layout Preferences"</p>

<p>Use the "browse" button to find the "dot" executable in the "bin"
	subfolder of your GraphViz distribution.</p>
<p>Your preference screen should look like this :</p>

<img src="images/dotprefs.jpg" alt="download" />

Step 3 : Getting started.
-------------------------

**That's all, the tool is ready to run now. Right-clicking a .gal file now brings up "Run As...->ITS model-check".**

<p>You can try to "File->New->Example->GAL examples"
	to get some example GAL models.</p>

<p>You can try to "File->New->Example->Fischer's Mutual exclusion"
	to get an example Petri net model.</p>

<p>Or create a "New->General project" to host your own project and create a file with .gal extension to start the editor.</p>


