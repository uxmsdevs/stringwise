# StringWise - Bitwise Ops on Strings

This class' idea has emerged from the using of bitwise on the strings. So, you do not have any restrictions anymore about using bitwise such as on database or elsewhere.

You can use bitwises on menu groups in databases or relative structures on other similar uses. Also on determining **user privileges** on your system, this is very very useful, and have control statement. So you can use this very basically.

### For example, suppose you have some usergroups like this:
```php
/**************************************
/******* BITWISE USER GROUPS **********
/**************************************
const User = 1;                 //1
const NormalAdmin = 3;          //11
const SysAdmin = 7;             //111

const Reading = 8;              //1000
const Writing = 16;             //10000
const ToAuthorize = 32;         //100000

const Management = 64;          //1000000
const ContentManagement = 128;  //10000000
const SubOperator = 256;        //100000000
const Operator = 768;           //1100000000
const Accounting = 1024;        //10000000000
```
> Note: I set up Operator as **768**, because Operator needs to have the SubOperator rights too.. Do not make math addition process on your own, use always methods..

### For a quick example:

I have NormalAdmin, Reading and Writing permissions, so:
```php
$myPerms = StringWise::mOrInt([
    StringWise::NormalAdmin,
    StringWise::Reading,
    StringWise::Writing
]); // gives 27
```
probably you think that;

**27** => NormalAdmin, Reading and Writing

AND

**27** => User, NormalAdmin, SysAdmin, and Writing

are both true.

**but NOT!!**

> btw, the addtion of User, NormalAdmin, SysAdmin, and Writing will gives you **23**, not **27** :) because if you are a SysAdmin, you have NormalAdmin and User privileges already and do not need to be add.

### If I have User, NormalAdmin, SysAdmin and Writing permissions, so:
```php
$myPerms = StringWise::mOrInt([
    StringWise::User,
    StringWise::NormalAdmin,
    StringWise::SysAdmin,
    StringWise::Writing
]); //gives 23
```
If you have SysAdmin, you have NormalAdmin and User privileges, as we want it to be. If you have SysAdmin, in the addition process it will automatically eliminate the NormalAdmin and User privileges, if you use methods, you do not need to be worry about it.
