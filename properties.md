---
title: Property Syntax
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: properties.html
summary: Syntax of Properties
---


# Property Logic

You will find here documentation syntax of possible properties in a GAL file.

The properties currently supported are one of :

* **Safety Properties** : assertions over the reachable states, regardless of how they are reached. 
This includes queries such as : 
   * Can I reach such a state ? 
   * Is this boolean assertion an invariant ? 
   * What is the maximum value of this variable ?
* **CTL properties** : assertions over the (infinite) computation tree, where you can observe branchings from a given state. 
This includes properties such as :
   * Can I reach a state that has no successors (deadlock) ?  
   * Whenever this (failure) situation is reached, can we guarantee that eventually a (desired) situation will be reached ?
   * From any reachable state, does there exist a path to a state satisfying some condition ?
* **LTL properties** : assertions over the set of infinite runs that the system allows.
This includes properties such as :
  * Can this event occur infinitely often ?
  * Given that this event occurs infinitely often (fairness constraint), does this property hold ?

Properties are added at the bottom of a GAL file; each property is introduced by the keyword **property**
followed by its unique name, its type, and the body of the property definition.

After writing the properties, right click the GAL file to "Run As -> ITS Model-check" to get the analysis results.
  
## Atomic propositions

Atomic propositions reuse the [expression syntax](galbasics.md) for Boolean expressions, with some additional constraints and features.
 
The context of the property is always the context of the **main** instance of the specification.
If that is a GAL type, simply use the same syntax as GAL boolean expressions.
If it is a composite, use a column **:** to access nested variables (see examples on [Composite](cgalbasics.md) page). 

Array indexes must be constants, **tab[2]** is ok, **tab[b]** is not because **b** is a variable.

## Safety Properties

These properties can be verified by building the state space.
**its-reach** is the primary solver for this category of problems.

This small example shows the syntax for declaring these properties.

{% highlight C %}
{% include_relative galfiles/sample-14.gal %}
{% endhighlight %}

### Reachable, Invariant, Never

For these three types of properties, a Boolean expression is expected as body for the property.

 * reachable : true if **at least one** reachable state satisfies the predicate
 * invariant : true if **all of** reachable states satisfy the predicate
 * never : true if **none of** the reachable states satisfy the predicate
 
Never and invariant are dual of one another, which one you use is a matter of preference.
Never is typically used to specify undesired behavior, whereas invariant is used for desired ones,
 so that "true" formulas means the system is doing what it should.

### Bounds

Bounds are a useful tool to understand variable domains better.
The body of a __bounds__ property is either a single variable, or a sum of variables.
The tool will answer with the minimal and maximum value of the provided sum of variables.  

e.g.
<code>
Bounds property b1 :0 <= a <= 1<br/>
Bounds property b2 :0 <= a+b <= 1
</code>

Note that for __b2__ the tool does not actually report what was asked for __a + b + tab[0] + c__ ; this is due to variable simplifications.
In this example all cells in the array __tab__ are always **0** and __c__ is always **2**.

The tool does warn that it is simplifying variables away :
<code>
INFO:Removed 1 constant variables :c=2<br/>
INFO:Removed constant array :tab[]
</code>

And will print a message : 
<code>
WARNING:For property b2 will report bounds of ((a+b)+2) without constants. Add 2 to the result in the trace.
</code>

## CTL

CTL properties are built from the following operators where **p** and **q** are CTL formulas.
* true, false, comparison of a variable to a constant : atomic predicates. The syntax of boolean predicates is currently (June 2017) still very limited in CTL.
* Usual Boolean connectors : AND &&, OR &#124;&#124;, NOT ! 
* Unusual Boolean connectors (but very useful for CTL) : IMPLY ->, EQUIVALENCE <->
* Temporal operators :
  * EF(p), EX(p), E(p U q), EG(p) : existential modalities for Finally, neXt, Until, and Generally.
  * AF(p), AX(p), A(p U q), AG(p) : universal modalities

Parenthesizing is necessary, the parser likes it that way, so add parenthesis until it's happy (no more red underline).

The semantics are not quite text-book; in presence of deadlocks, **EG p** will stutter and accept dead states satisfying **p**.
This does not affect the semantics of **EX, AX**, so that **AG (EX (true))** does test for absence of deadlocks.
For a more formal presentation of this semantics see this document [Jiri Srba's CTL semantics document](files/CTL-semantics.pdf), used in the [MCC](http://mcc.lip6.fr).
These semantics are more natural for reasoning.

For instance, **AF(p)** when some deadlock states satisfying **!p** are reachable without ever validating **p**, but there are no loops or SCC satisfying **!p**:
* is **true** with textbook semantics, because it reduces to **! (EG !p)**, so that a reachable deadlock state satisfying **!p** is not accepted as a counter example
* is **false** with the semantics we use, a path satisfying **!p** to a deadlock state satisfying **!p** is indeed a counter-example

This small example shows some CTL properties on a simple three philosopher example.

{% highlight C %}
{% include_relative galfiles/nPhils.gal %}
{% endhighlight %}


## LTL

LTL properties are built from the following operators where **p** and **q** are LTL formulas.
* true, false, comparison of a variable to a constant : atomic predicates. 
The syntax of boolean predicates is decently permissive as long as all variables in the expression belong to a single GAL instance, but comparisons of variables belonging to different subcomponents is not supported.
* Usual Boolean connectors : AND &&, OR &#124;&#124;, NOT ! 
* Unusual Boolean connectors (but very useful for LTL) : IMPLY ->, EQUIVALENCE <->
* Temporal operators :
  * p U q, , p W q, p M q, p R q : operators for Until, Weak Until, Strong Release, and Release
  * F p, G p, X p : Future, Generally and neXt operators

The parser is relatively lenient, but parenthesizing still avoids surprises.
For more info on LTL operators and their semantics, please visit [Spot](https://spot.lrde.epita.fr/concepts.html#ltl) or play with their excellent
[online LTL to Buchi](https://spot.lrde.epita.fr/trans.html) tool.
