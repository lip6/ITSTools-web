---
title: Composite Guarded Action Language Basics
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: cgalbasics.html
summary: GAL Concepts.
---

# Composite concepts

## GAL Specification

GAL files are simply text files with the extension .gal . For example, foo.gal is a valid GAL filename. 
Each file defines a single GAL _specification_ that may contain one or more type declarations, a **main** instance, and properties.

## Composite Type Declaration

A Composite GAL type declaration (or just a Composite) is characterized by a name, and contains a sequence of declarations (instances, synchronizations).

A Composite is declared with the keyword **composite**, followed by the system name. 
The name must start with a letter of the alphabet and should be a C-style identifier (only using letters, underscore and numbers). 

A good practice is to give a meaningful name to the system created, particularly if it will be reused in a further Composite ITS definition.

The body of the system name are then placed between a pair of braces.

The [previous section](cgal.md) shows a declaration of an example Composite GAL system named _game_.

## Instance declarations

A Composite GAL model declares instances. 
The instances manipulated in a Composite can GAL, Composite, or arrays of these. 
There are no variables besides the instances in a Composite. 

There are no dynamic allocation or variable length structures such as lists.
To model these using an array is only possible if an upper bound on its size is known a priori.

In this section, we describe how instance of a composite GAL are declared.

### Instance  variables

Plain instance variables are introduced with their **type** followed by the instance name starting with a letter. 
The instance name must be a C-style identifier.

The name must be unique within the scope of the composite definition, and cannot be reused for another instance within the same type. 

Each instance can optionally be initialized, as described in the [section on parameters](pgal.md).
Otherwise it has as initial state the initial defined by its type.

This example of a composite __game__ contains two instances :

{% highlight C %}
{% include_relative galfiles/sample-9.gal %}
{% endhighlight %}

### Array declarations

An array declaration allows to declare a fixed size array of instances. 
All instances must have the same type.

Like simple integer variables, each entry in the array needs to be initialized.
A GAL array variable is declared using the keyword <span class="galElement">array</span> followed by the array size N within square brackets, then the array name. 

Each cell of the array needs to be initialized, to this end, a list of N comma separated integers surrounded by parenthesis (or integer expressions of constants and/or type parameters) should be provided. 
If no initialization is provided, all array cells are set to **0** initially.
A semicolon ends the array declaration.

Here is an example of a system with a declaration of an array:

{% highlight C %}
{% include_relative galfiles/sample-4.gal %}
{% endhighlight %}

## Expressions

GAL expressions can be either integer expressions or Boolean expressions, depending on the context. 
We give here the syntax of these expressions, which is mostly directly taken from C (or Java). 

Usual priorities between operators are observed (e.g. Boolean AND stronger than OR, integer multiplication stronger than addition). 
If in doubt, parenthesis can be used to force an evaluation order.

### Boolean expressions

Boolean expressions are allowed in guards of transitions. It is also possible to write arithmetic expressions, with boolean appearance (as in C), which will be worth 1 or 0 depending on whether they are true or false (see Wrapper)

The basic expressions are **true** and **false**.

The usual boolean operators are present in GAL,

| Operation | Operator | 
| Conjunction (OR) | &#124;&#124; | 
| Disjunction (AND) | && |  
| Negation (NOT) | ! |  

Basic Boolean expressions can be any kind of comparison of two integer expressions using one of the comparison operators :

| Operation | Operator |
| Greater than | > |
| Lesser than | < |
| Greater or equal | >= |
| Lesser or equal | <= |
| Equals | == |
| Not equal | != |



### Integer expressions

#### Binary Operators

The standard linear integer arithmetic operators are provided.
Division is integer division.

| Operation | Operator | Example | Result |
| Addition | + | 3 + 2 | 5 |
| Subtraction | - | 3 - 2 | 1 |
| Modulo | % | 7 % 2 | 1 |
| Division | / | 7 / 2 | 3 |

We also provide multiplications useful in some contexts

| Operation | Operator | Example | Result |
| Multiplication | * | 3 * 2 | 6 |
| Power | ** | 2 ** 3 | 8 |

Finally, we offer bitwise manipulation operators :

| Operation | Operator | Example | Result |
| bitwise OR | &#124; | 2 &#124; 3 | 3 | 
| bitwise AND | & | 2 & 3 | 2 |
| bitwise XOR | ^ | 2 ^ 3 | 1 |
| Left shift | &lt;&lt; | 1 << 3 | 8 |
| Right shift | &gt;&gt; | 7 >> 2 | 1 |

#### Unary operators

Standard prefix unary operators are provided :

| Operation | Operator | 
| Unary minus | - | 
| Bitwise complement | ~ |  

#### Terminal expressions

Terminal integer expressions are simply : 
* a reference to plain integer variables, **var** 
* a reference the cell of an array **tab[index]**, 
* or a reference to a parameter **$param** 

When accessing a cell of an array **tab[index]**, the **index** expression is inductively an arbitrarily complex integer expression.

#### Wrapper of boolean expressions

Boolean expressions can be raised to integer expressions with the interpretation **1** for _true_ and **0** for _false_,
 by surrounding the Boolean expression with parenthesis. 
 
This encapsulation of Boolean expressions as integers enables many (programming/modeling) tricks commonly encountered in C.

Note that the reverse is not possible, in particular, assignments cannot be nested within Boolean conditions, they do not return a value like in C. 
Hence all Boolean expressions are by construction side-effect free.

`Example : myVariable = (a == 0) * 100 ;_//myVariable is 100 or 0_`


## Transitions

### Transition declaration

Transitions allow to step atomically from a source state to a (set of) successor state(s). Transitions are enabled by a guard, which is a Boolean expression and may carry a label that is a string. If the guard is true in the current state, the transition can be fired, executing all the actions it contains in sequence. Actions can be assignments, calls to a label or other statements as described below. Labeled actions _cannot be fired_ if they are not called from another transition or synchronized externally (see ITS composite). Transitions without a label are "private" and can be fired any time their guard is true, with interleaving semantics. A self-contained GAL (not intended for further composition) typically bears no labels on transitions.

Syntactically, a transition is declared with the keyword <span class="galElement">transition</span>, followed by a unique identifier for the transition. The transition guard (a Boolean expression) is surrounded by brackets (that can be "true" if the transition is always enabled). The transition can optionally be labeled, as introduced with the keyword <span class="galElement">label</span> followed by double quoted string defining the label. Finally the statements comprising the transition body are placed in a block surrounded by curly braces.

This example system contains two transitions of which one is labeled :

{% highlight C %}
{% include_relative galfiles/sample-6.gal %}
{% endhighlight %}

### Statements

Statements are operations that generally update the state of the system variables. 

Statements are sequentially composed using a semi-column **;** within the body of a transition.

The most common type of statement is the assignment of an integer expression on system variables to a system variable. 

The call to a label statement introduces non-determinism in the execution by offering several alternatives (_any_ transition bearing the label can be fired).

Other basic statements include an **if-then-else** control structure, and an **abort* instruction.

Other statements such as limited **for-loop** control structure are provided (see [parametric GAL](pgal.md)). 

#### Assignment

Assignments are composed of a left-hand side (lhs), that must be a reference to a variable or to the cell of an array, and a right-hand side (rhs) that is an integer expression. 

When the lhs is a reference to an array, the target index within the array can be expressed using an arbitrarily complex integer expression.

#### Call action

The call action allows to call a label of the current GAL system, i.e. non-deterministically choose any of the enabled transitions that bear this label, and execute its actions. 

This powerful mechanism allows to model much more concisely when the transition relation carries non-determinism.

For instance, a transition that non deterministically assigns a value between 0 and N to two variables X and Y can be represented as containing two calls to labels "assignX" and "assignY". 
We can then build N transitions tX0, tX1... (resp. tY0, tY1...) bearing label "assignX" (resp. "assignY"), each of them with a [true] guard and a single assignment of a value to the designated variable. 
We thus accurately represent the transition relation with **2N+1** transitions rather than **N^2** transitions.

Calls can also be used to simulate some control structures. 
For instance, If-Then-Else(cond, actif, actelse) can be simulated by two transitions bearing label "ite", with guards cond and not cond respectively, and body actif and actelse respectively. 

Calling label "ite" in a transition body is like executing an if-then-else block. 

Note that the whole ITS semantics is defined using sets, i.e. the successor relation returns a set of successors. 
Hence if no labeled action is enabled in some states at the point of call, no successors are produced, canceling the effect of the calling the enclosing transition for the concerned states, like an abort action.

Syntactically, a call is introduced by the keyword <span class="galElement">self</span>, followed by a column '.', followed by a label between double quotes.

This example shows a use of a call to non deterministically update a variable.

{% highlight C %}
{% include_relative galfiles/call.gal %}
{% endhighlight %}

#### If-Then-Else action

To ease modeling, GAL provide the if-then-else alternative control structure. As mentioned above this behavior can also be implemented using calls.

The semantics are those you could expect, if the condition is true the "if" block is executed, otherwise the "else" block is executed (or nothing is done if there is no else block).

The syntax is taken from C or Java, <span class="galElement">if</span> followed by a Boolean condition between parenthesis, followed by a block between curly braces. Optionally, the statement can be completed by an <span class="galElement">else</span> followed by a second block of actions.

This example shows a use of an if then else to invert the value of a Boolean variable.

{% highlight C %}
{% include_relative galfiles/ite.gal %}
{% endhighlight %}


#### Abort action

The semantics of GAL (based on ITS definitions) allow a statement to return a set of successors, since GAL natively support non-determinism. The <span class="galElement">abort</span> statement returns the empty set of successors, hence it interrupts the current transition which then yields no successors.

The abort statement is mainly used to model transition relations where Boolean conditions with side effects need to be represented. It allows to have a transition with a guard, a few statements then typically an if-then-else or a variant using a call, of which some branches may encounter abort and cancel the transition effect for this branch.

The following example shows a use of abort to model the transition relation of a Time Petri net with two places a and b, and a transition t that moves tokens from a to b, with earliest firing time _eft_ and latest firing time _lft_. Time cannot elapse if an enabled transition has reached its latest firing time, but this test is complex, particularly when there are many transitions. Use of abort allows to concisely represent the semantics.

{% highlight C %}
{% include_relative galfiles/abort.gal %}
{% endhighlight %}





