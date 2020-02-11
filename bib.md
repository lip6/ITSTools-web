---
title: Bibliography on ITS-tools
---

GAL and ITS related papers
==========================

While some of the SDD related papers below present early versions of the formalism. Recent and up to date
 definitions relating to ITS and GAL can be taken from this document [.pdf](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/gal.pdf)

* (2016) My habilitation thesis contains up to date definitions and presents an overview of this work. 
_From Symbolic Verification to Domain Specific Languages_ Yann Thierry-Mieg. [.pdf](https://pages.lip6.fr/Yann.Thierry-Mieg/hdr-ytm.pdf)
* (2015) General overview of ITS-tools _Symbolic Model-Checking Using ITS-Tools_ Yann Thierry-Mieg.  In _Proceedings of the International Conference on Tools and Algorithms for the Construction and Analysis of Systems (TACAS)_, 2015 
[.pdf](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/TACAS_2015_author.pdf)
* (2013) An abstract definition of the mechanisms that allow to evaluate GAL semantics symbolically (no ITS compositions)<br/>
 _Towards Distributed Software Model-Checking using Decision Diagrams._  Maximilien Colange, Souheib Baarir, Fabrice Kordon, and Yann Thierry-Mieg.  In _Proceedings of the International Conference on Computer Aided Verification (CAV'13)_, LNCS, 2013. Springer. 
 [.pdf](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/mlhom.pdf)

### DDD and SDD Definitions

* (2002) The paper that defines DDD and inductive homomorphisms: <br/>
  Jean-Michel Couvreur, Emmanuelle Encrenaz, Emmanuel Paviot-Adet, Denis
  Poitrenaud, and Pierre-Andre Wacrenier.
  Data decision diagrams for Petri net analysis.
  In <em>Proc of the 23th International Conference on
  Application and Theory of Petri Nets (ICATPN'02)</em>, volume 2360 of <em>
  Lecture Notes in Computer Science</em>, pages 101-120, June 2002. Springer Verlag. 
  [.pdf](http://www.lip6.fr/ddd-download/icatpn02.pdf) [Presentation slides (ppt)](http://www.lip6.fr/ddd-download/PN2002.zip)
* (2005) The paper that defines SDD and how to use hierarchy in the description of a state and encode saturation (manually): 
J.-M. Couvreur, Y. Thierry-Mieg. Hierarchical Decision Diagrams to Exploit Model Structure. In <em> 25th IFIP WG 6.1 International Conference on Formal Techniques for Networked and Distributed Systems (FORTE'05), Lecture Notes in Computer Science (LNCS)</em>, Taipei, Taiwan, pp. 443-457, (Springer-Verlag)
[[.pdf](http://www.lip6.fr/ddd-download/forte05.pdf) ]
* (2005) Yann Thierry-Mieg’s PhD thesis where extended discussions on SDD and their inception can be found (in English): 
THIERRY-MIEG Yann. Techniques for Model-Checking of high-level specifications. <em>PhD Thesis. 2004</em>
[[.ps.gz](http://www.lip6.fr/ddd-download/theseYTM.ps.gz) ]
[[Presentation slides (ppt)](http://www.lip6.fr/ddd-download/Thesev20.zip) ]
* (2008) The paper that introduces automatic saturation in DDD/SDD : 
Alexandre Hamez, Yann Thierry-Mieg, Fabrice Kordon: Hierarchical Set Decision Diagrams and Automatic Saturation. In <em> Petri Nets 2008: Applications and Theory of Petri Nets, 29th International Conference, PETRI NETS 2008</em>, Xi'an, China, June 23-27, pp. 211-230 (Springer-Verlag) 
[[.pdf](http://www.lip6.fr/ddd-download/atpn08.pdf) ]
[[Presentation slides](http://www.lip6.fr/ddd-download/PN2008.zip) ]
* (2009) An extended journal version of the ICATPN'08 paper, includes the definition of Instantiable Petri Nets: 
Alexandre Hamez, Yann Thierry-Mieg, Fabrice Kordon: Building efficient Model-Checkers using Hierarchical Set Decision Diagrams and Automatic Saturation. 
In <em> Fundamenta Informatica, Special Issue selected Best papers from Petri Nets 2008</em>, (IOS Press)
[[.pdf](http://www.lip6.fr/ddd-download/fi-pn-2008.pdf) ]
* (2009) Introducing the Instantiable Transition System semantic framework, a general formalism that helps express systems in a way that allows efficient SDD solutions.
Yann Thierry-Mieg, Denis Poitrenaud, Alexandre Hamez and Fabrice Kordon: Hierarchical Set Decision Diagrams and Regular Models. 
In <em> Tools and Algorithms for the Construction and Analysis of
               Systems, 15th International Conference, TACAS 2009, Held
               as Part of ETAPS 2009 </em>, York, UK, March 22-29,
               2009. LNCS vol. 5505, pp. 1-15 (Springer)
[[.pdf](http://www.lip6.fr/ddd-download/tacas09.pdf) ]
[[Presentation slides (ppt)](http://www.lip6.fr/ddd-download/TACAS2009.zip) ]
* (2009) Alexandre Hamez's PhD dissertation (IN FRENCH), which contains the most current definitions of the rewriting strategies for automatic saturation.         
[[.pdf](files/manuscrit_ahamez.pdf) ]
[[Presentation slides (pdf)](files/transparents_soutenance_ahamez.pdf) ]

Case Studies and applications
=============================



* (2008) Using Instantiable Petri Nets to check the consistency of UML behavioral specifications (see also [ BCC website ](http://move.lip6.fr/software/BCC/)):
		 Yann Thierry-Mieg, Lom-Messan Hillah. UML behavioral consistency checking using instantiable Petri nets. In <em> Innovations in Systems and Software Engineering, Volume 4, Issue 3, Oct. 2008,
		DOI  - 10.1007/s11334-008-0065-0 </em> pp.293-300 [SpringerLink](http://www.springerlink.com/content/vt3r462270357560), 
[[.pdf](http://www.lip6.fr/ddd-download/bcc08.pdf) ]	
* (2008) Applying SDD to a control problem from the domain of Intelligent Transportation Systems:
            Beatrice Berard, Serge Haddad, Lom-Messan Hillah, Fabrice Kordon and Yann Thierry-Mieg. Collision Avoidance in Intelligent Transport Systems: towards an Application of Control Theory.
		      In <em> 9th International Workshop on discrete Event Systems (WODES'08), proceedings </em>  Goteborg, Sweden, pp. 346-351, (IEEE Press)
[[.pdf](http://www.lip6.fr/ddd-download/wodes08.pdf) ]	
* (2006) Using DDD to unfold a colored Petri net to a P/T net:
F. Kordon, A. Linard, E. Paviot-Adet. Optimized Colored Nets Unfolding. In <em>International Conference on Formal Methods for Networked and Distributed Systems (FORTE '06), Lecture Notes in Computer Science (LNCS)</em>, Paris, France, pp. 339-355, (Springer-Verlag)
[[.pdf](http://www.lip6.fr/ddd-download/forte06.pdf) ]
* (2006) Vincent Beaudenon’s PhD thesis where SDD are used for model-checking of Promela specifications (in French):
BEAUDENON Vincent. Diarammes de décision de données pour la vérification de systemes matériels. <em>PhD Thesis. 2006</em>
[[.ps](http://www.lip6.fr/ddd-download/theseVB.ps.gz) ]
* (2004) Using DDD to generate an aggregated state space exploiting symmetries &quot;à la&quot; <a href=http://www.di.unito.it/~greatspn/index.html>Well-Formed Nets</a> 
Y. Thierry-Mieg, J.-M. Ilié, D. Poitrenaud. A Symbolic Symbolic State Space Representation. In <em> 24th International Conference on Formal Techniques for Networked and Distributed Systems (FORTE '04) Lecture Notes in Computer Science (LNCS)</em>,  Madrid, Spain, pp. 276-291, (Springer-Verlag)
[[.pdf](http://www.lip6.fr/ddd-download/forte04.pdf) ]
[Presentation slides (ppt)](http://www.lip6.fr/ddd-download/FORTE2004.zip)
* (2004) Using DDD to model-check LfP, a DSL designed for distributed systems: 
F. Bréant, J.-M. Couvreur, F. Gilliers, F. Kordon, I. Mounier, E. Paviot-Adet, D. Poitrenaud, D. Regep, G. Sutre. 
Modeling and Verifying Behavioral Aspects", 
In <em>Formal Methods for Embedded Distributed Systems - How to master the complexity, Kordon Fabrice, Lemoine Michel, pp. 171-211, (Kluwer Academic Publishers)</em>, (ISBN : 1-4020-7996-6) [Bréant 2004]
               
