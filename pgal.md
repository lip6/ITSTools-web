---
title: Guarded Action Language : Parameters
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: pgal.html
summary: GAL Parameters.
---


### System parameters

A GAL type declaration can optionally declare one or more _type parameters_. 
A type parameter essentially declares a symbolic name for an integer constant, that can then be used within the various instructions of the GAL system (including initializations, typedef, guards, statements...). 

Parameter names start with a $ sign to avoid any confusion with the variables of the system. 
Parameters are given a value directly after their declaration. 

Note that when instantiating a GAL within the context of composite ITS, parameters can be given a value (different from the value given in the parameter declaration).
Thus type parameters can be used to simulate a constructor for the GAL.

Syntactically, parameters are given as a parenthesized comma separated list, just after the name of the system. 
Only constant expressions may be used in parameter initializations.

{% highlight C %}
{% include_relative galfiles/sample-param.gal %}
{% endhighlight %}


### Parameter type definitions

A parameter type definition allows to define a symbolic name for a given range of integers from min to max. These type definitions are used when declaring transition parameters. They allow to define a set of similar transitions in a compact and readable manner.

Syntactically, a type definition is introduced with the keyword <span class="galElement">typedef</span> followed by a unique name for this type, followed by the actual range specification in the form "= min..max;". min and max are integer expressions built from type parameters and constants only.

Here is an example of a system with some parameter type definitions:

{% highlight C %}
{% include_relative galfiles/paramtype.gal %}
{% endhighlight %}


### Transition parameters

Transitions can optionally define one or more parameters that allow a more concise and readable representation of a complex transition relation. Parameters have a type that is defined as a range of integers, introduced at the system level using a **typedef**. Semantically, each parameter can be replaced in the transition effects by each of the possible values in its type, producing several alternative transitions from a single transition that bears parameters.

Syntactically, transition parameters are declared in a parenthesized comma separated list just after the transition name, with a syntax reminiscent of arguments for a function or method. Each parameter is defined by giving its type followed by the parameter name which must start with a $ sign and cannot shadow a type (sytem level) parameter name.

This example, already used above when discussing type parameters:

{% highlight C %}
{% include_relative galfiles/param.gal %}
{% endhighlight %}

Is equivalent to this version that does not use parameter definitions. :

{% highlight C %}
{% include_relative galfiles/param.inst.gal %}
{% endhighlight %}


System parameters (introduced just after the name of the system) can be used anywhere in the specification. Transition parameters (introduced just after the name of the transition) have the transition body as scope.

#### <a name="forloop"></a>d) For loop action

To ease modeling, GAL provide a constrained For loop iterative control structure. This mechanism is close to macro expansion, the loop is unfolded before analysis is performed.

A for loop defines a local parameter which has as scope the body of the loop. Since the domain of the parameter is is both known and finite, the loop can be simply unrolled.

The syntax reminiscent of Java foreach loop, <span class="galElement">for</span> followed by <span class="galElement">$forparam : paramType</span> between parenthesis, followed by a block (the loop body) between curly braces.

This example shows a use of a for loop to set values in an array.

{% highlight C %}
{% include_relative galfiles/for.gal %}
{% endhighlight %}

It is strictly equivalent to this version.

{% highlight C %}
{% include_relative galfiles/for.inst.gal %}
{% endhighlight %}


### <a name="instantiate"></a>5.2 Parameter Instantiation

Parameter instantiation consists in applying the following steps, in this order:

1.  All type level parameters (symbolic constants) are replaced by their value in all expressions.
2.  "For" loops are unrolled, i.e. the statement is replaced by n occurrences of the body statement, where the loop variable is replaced by its value in each of these occurrences. The unrolling of loops is done first on nested statements.
3.  Transition parameters are then instantiated. Each transition that has parameters can produce several transitions. Suppose transition has parameters $p1,..$pk in domains D1,..DK (see typedef keyword). 
We first instantiate $p1 giving |D1| transitions, in which $p1 is substituted by one of the values in D1\. More precisely, any occurrence of $p1 is replaced by its numeric value, in the guard, label, and in the transition body (where the parameter $p1 may occur in calls to a label). Each occurrence of the transition has a new name allowing traceability. On the fly, the guard of the newly created transitions is simplified, and no transition is produced if it happens to be false. This can skip construction of many transitions in some examples. Because we do this iteratively and test after each parameter instantiation if the transition is false, the number of "skipped transitions" reported in the verbose trace can thus be smaller than the difference between the Cartesian product of domain sizes and the number of transitions actually produced.

We then apply simplifications, currently we do the following rather trivial simplifications:

1.  Arithmetic and Boolean simplifications, on all constant expressions. Thus we replace (2 + 2) by (4), we also apply basic absorbing (0 * x -> 0, false && x -> false, true || x -> true) and neutral element (1 * x -> x, false || x -> x, true && x-> x) simplifications.
2.  We replace calls to non existing labels by an abort statement. These can occur as a result of other transition simplifications.
3.  We replace any sequence of statements containing an abort by a single abort statement. We destroy any transition with abort as body.
4.  Transitions with a false guard are destroyed.
5.  if (c) { s1 } else { s2 } is replaced by s1 if c can be reduced to true or to s2 if c can be reduced to false.
6.  Constant variables are identified and simplified away. To do this, we first track all write accesses to variables or arrays. Initially, all variables and array cells are supposed constant. We then scan all write access (assignments) in the specification. If a variable is assigned to, it isn't a constant. A write access to a single cell of an array (tab[3]) means this cell is not constant. A write access to an array using an index expression (tab[i]) discards the whole array. Variables that are actually constant can then be replaced by their intial values in the whole specification. Simple constant variables and arrays that are entirely constant are then removed from the state signature, i.e. they are totally discarded. TODO : Because we do not trace this effect beyond reporting in the verbose trace, the fact some variables disappear can lead to some confusion from the user, we need to improve this traceability.
7.  If we can find within a sequence of statements increments and/or decrements of a variable, and that they are commutative with statements that separate them, we fuse their effects. If the total effect is to leave the variable unchanged, the idle statement x=x+0 is removed. This can occur for instance with test-arc behavior in Petri nets.
8.  If two transitions that bear a label called only once and are identical in effects up to renaming of self, label and parameters, they are fused and only one of them is kept. This makes the specification slightly more compact, but is redundant with simplifications that occur in the model-checking engine. This reduction is called "fusion of isomorphic effects".

### <a name="separate"></a>5.3 Parameter Separation

Parameter separation consists in rewriting conjunction of choices (as expressed by transitions with several parameters) to sequence of choices where possible.

De-generalizing parametric transitions that bear a large number of parameters can produce very large GAL specifications. In general, degeneralization produces as many transitions as the size of the cartesian product of the domains of the formal parameters. But in many case, the full combinatorial unfolding can be avoided, allowing a compact transition representation while preserving semantics.

A transition has two independent parameters if it contains no statement that uses both parameters. Such a transition can be split into two labelled sub-transitions, one for each parameter, the semantics being preserved by calling the labels of these two sub-transitions. Statements are moved to the appropriate sub-transitions depending on the parameter they rely on. We thus obtain three transitions: the modified original one, that calls the sub-transitions and has no more parameter, and the sub-transitions, each of which has a single parameter. If the domain sizes of both parameters are called $r_1$ and $r_2$, we obtain after the instantiation of the parameters $r_1 + r_2 + 1$ transitions instead of $r1 \times r_2$. Thanks to the sequence and call statements, the semantics is preserved.

More generally, the detection of the parameters to be separated in a given transition is done by building an hypergraph, whose nodes are parameters and where an hyperedge is added for each statement, connecting together all the parameters used in it. We then consider the connectivity graph between parameters induced by this hypergraph. If a parameter $p$ has no neighbor, it can be separated: a new transition with parameter $p$ and a new label $l_p$ is built, whose body is the sequence of statements that depend on $p$. These statements are replaced in the original transition by a call the label $l_p$. Similarly, a parameter $p_1$ that has a single neighbor $p_2$ can also be separated. We similarly build a transition with the statements depending upon $p_1$ alone or $p_1$ and $p_2$. This transition bears both parameters $p_1$ and $p_2$, and is labelled with a new label $l_{p_2}$. Parameter $p_1$ can then be removed from the original transition, and the relevant statements be replaced by a call to label $l_{p_2}$. The procedure can be iterated on the simplified original transition, where $p_2$ may now be separable too. Instantiation will also instantiate $p_2$ in $l_{p_2}$, so as to ensure consistency for the values of $p_2$ across the separated transitions.

This procedure has low complexity, depending on the size of the parametric GAL. It is applied before instantiation of the parameters. Relying on the distributivity between sequential and parallel composition, it helps producing transition relation expressed as sequences of parallel compositions, yielding much more compact representations than an expanded parallel composition of sequences (such as used by LTSmin). This factored representation would not be efficient without the ability of symbolic operations to deal with parallel composition natively. One may see this transform as a manner of delaying the computation of the combinatorial number of instantiations until symbolic evaluation time, where the symbolic data structures help with the combinatorics.

This example transition of a colored Petri net taken from [this VendingMachine example](http://mcc.lip6.fr/pdf/DrinkVendingMachine-form.pdf) of the 
[Model checking contest at Petri nets](http://mcc.lip6.fr) shows how this reduction works in practice.


This is an extract of the [full model](galfiles/drink-vending-2-col.gal). Before separation, we have many independent parameters. In fact here all parameters are independent, since no statement simultaneously uses two parameters. Furthermore parameters $o1 $o2 and $o3 play a very symmetric role.

{% highlight C %}
{% include_relative galfiles/vendingsimple.gal %}
{% endhighlight %}

After separation (and fusion of isomorphic effects on $o1 $o2 and $o3) we obtain the following model :

{% highlight C %}
{% include_relative galfiles/vendingsimple.sep.gal %}
{% endhighlight %}

This model when instantiated is still compact as shown here. Compare to what a [plain instantiation ](galfiles/vendingsimple.inst.gal) obtains; obviously when applicable this approach helps to scale as it can avoid exponential blowups in specification size.

{% highlight C %}
{% include_relative galfiles/vendingsimple.flat.gal %}
{% endhighlight %}](http://mcc.lip6.fr)

## Initializing Instances


this is done using the "=" symbol followed by recalling the type of the instance and specifying
values for type parameters as desired.
The default initial value for integer variables is **0**.
 
 
The initial value can be expressed using an integer expression built of constants and/or type parameters, but it cannot refer to other variables. 
The declaration ends with a semicolon.
 