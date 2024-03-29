# chinese-address-generator
中国地址生成器 - 三级地址 四级地址 随机生成完整地址

## 数据
数据在`src/data`文件夹中, 可以自己实现想要的相关逻辑

使用`Composer`
### 安装依赖
```bash
$ composer require nizerin/chinese-address-generator
```

### 生成一级地址
```php
$generator = new \Nizerin\ChineseAddressGenerator\Generator();

$fakeAddress = $generator->generateLevel1();
// => {region: "上海", code: "310000"}
```

### 生成二级地址
```php
$generator = new \Nizerin\ChineseAddressGenerator\Generator();
$fakeAddress = $generator->generateLevel2();
// => {region: "上海市市辖区", code: "310100"}
```

### 生成三级地址
```php
$generator = new \Nizerin\ChineseAddressGenerator\Generator();
$fakeAddress = $generator->generateLevel3(); 
// => {region: "上海市市辖区浦东新区", code: "310115"}
```

### 生成四级地址
```php
$generator = new \Nizerin\ChineseAddressGenerator\Generator();
$fakeAddress = $generator->generateLevel4(); 
// => {region: "上海市市辖区浦东新区东海农场", code: "310115402000"}
```

### 生成完整地址
**注意: 该地址是瞎编的。按照这个地址去找不能保证绝对有**
```php
$generator = new \Nizerin\ChineseAddressGenerator\Generator();
$fakeAddress = $generator->fabricateFullAddress();
// => {region: "上海市市辖区浦东新区外高桥保税区005号606室", code: "310115501000"}
```

*P.S.: 生成规则:(001-1400)号(101-909)室*

### 原项目地址
```
https://github.com/moonrailgun/chinese-address-generator
```

## 关于贡献
基于MIT开源协议

