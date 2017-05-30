var self = self || {};
var THREE = {
    REVISION: "70"
};
if (typeof module === "object") {
    module.exports = THREE
}
if (Math.sign === undefined) {
    Math.sign = function(a) {
        return (a < 0) ? -1 : (a > 0) ? 1 : 0
    }
}
THREE.MOUSE = {
    LEFT: 0,
    MIDDLE: 1,
    RIGHT: 2
};
THREE.CullFaceNone = 0;
THREE.CullFaceBack = 1;
THREE.CullFaceFront = 2;
THREE.CullFaceFrontBack = 3;
THREE.FrontFaceDirectionCW = 0;
THREE.FrontFaceDirectionCCW = 1;
THREE.BasicShadowMap = 0;
THREE.PCFShadowMap = 1;
THREE.PCFSoftShadowMap = 2;
THREE.FrontSide = 0;
THREE.BackSide = 1;
THREE.DoubleSide = 2;
THREE.NoShading = 0;
THREE.FlatShading = 1;
THREE.SmoothShading = 2;
THREE.NoColors = 0;
THREE.FaceColors = 1;
THREE.VertexColors = 2;
THREE.NoBlending = 0;
THREE.NormalBlending = 1;
THREE.AdditiveBlending = 2;
THREE.SubtractiveBlending = 3;
THREE.MultiplyBlending = 4;
THREE.CustomBlending = 5;
THREE.AddEquation = 100;
THREE.SubtractEquation = 101;
THREE.ReverseSubtractEquation = 102;
THREE.MinEquation = 103;
THREE.MaxEquation = 104;
THREE.ZeroFactor = 200;
THREE.OneFactor = 201;
THREE.SrcColorFactor = 202;
THREE.OneMinusSrcColorFactor = 203;
THREE.SrcAlphaFactor = 204;
THREE.OneMinusSrcAlphaFactor = 205;
THREE.DstAlphaFactor = 206;
THREE.OneMinusDstAlphaFactor = 207;
THREE.DstColorFactor = 208;
THREE.OneMinusDstColorFactor = 209;
THREE.SrcAlphaSaturateFactor = 210;
THREE.MultiplyOperation = 0;
THREE.MixOperation = 1;
THREE.AddOperation = 2;
THREE.UVMapping = 300;
THREE.CubeReflectionMapping = 301;
THREE.CubeRefractionMapping = 302;
THREE.EquirectangularReflectionMapping = 303;
THREE.EquirectangularRefractionMapping = 304;
THREE.SphericalReflectionMapping = 305;
THREE.RepeatWrapping = 1000;
THREE.ClampToEdgeWrapping = 1001;
THREE.MirroredRepeatWrapping = 1002;
THREE.NearestFilter = 1003;
THREE.NearestMipMapNearestFilter = 1004;
THREE.NearestMipMapLinearFilter = 1005;
THREE.LinearFilter = 1006;
THREE.LinearMipMapNearestFilter = 1007;
THREE.LinearMipMapLinearFilter = 1008;
THREE.UnsignedByteType = 1009;
THREE.ByteType = 1010;
THREE.ShortType = 1011;
THREE.UnsignedShortType = 1012;
THREE.IntType = 1013;
THREE.UnsignedIntType = 1014;
THREE.FloatType = 1015;
THREE.UnsignedShort4444Type = 1016;
THREE.UnsignedShort5551Type = 1017;
THREE.UnsignedShort565Type = 1018;
THREE.AlphaFormat = 1019;
THREE.RGBFormat = 1020;
THREE.RGBAFormat = 1021;
THREE.LuminanceFormat = 1022;
THREE.LuminanceAlphaFormat = 1023;
THREE.RGBEFormat = THREE.RGBAFormat;
THREE.RGB_S3TC_DXT1_Format = 2001;
THREE.RGBA_S3TC_DXT1_Format = 2002;
THREE.RGBA_S3TC_DXT3_Format = 2003;
THREE.RGBA_S3TC_DXT5_Format = 2004;
THREE.RGB_PVRTC_4BPPV1_Format = 2100;
THREE.RGB_PVRTC_2BPPV1_Format = 2101;
THREE.RGBA_PVRTC_4BPPV1_Format = 2102;
THREE.RGBA_PVRTC_2BPPV1_Format = 2103;
THREE.Projector = function() {
    console.error("THREE.Projector has been moved to /examples/js/renderers/Projector.js.");
    this.projectVector = function(a, b) {
        console.warn("THREE.Projector: .projectVector() is now vector.project().");
        a.project(b)
    };
    this.unprojectVector = function(a, b) {
        console.warn("THREE.Projector: .unprojectVector() is now vector.unproject().");
        a.unproject(b)
    };
    this.pickingRay = function(a, b) {
        console.error("THREE.Projector: .pickingRay() is now raycaster.setFromCamera().")
    }
};
THREE.CanvasRenderer = function() {
    console.error("THREE.CanvasRenderer has been moved to /examples/js/renderers/CanvasRenderer.js");
    this.domElement = document.createElement("canvas");
    this.clear = function() {};
    this.render = function() {};
    this.setClearColor = function() {};
    this.setSize = function() {}
};
THREE.Color = function(a) {
    if (arguments.length === 3) {
        return this.setRGB(arguments[0], arguments[1], arguments[2])
    }
    return this.set(a)
};
THREE.Color.prototype = {
    constructor: THREE.Color,
    r: 1,
    g: 1,
    b: 1,
    set: function(a) {
        if (a instanceof THREE.Color) {
            this.copy(a)
        } else {
            if (typeof a === "number") {
                this.setHex(a)
            } else {
                if (typeof a === "string") {
                    this.setStyle(a)
                }
            }
        }
        return this
    },
    setHex: function(a) {
        a = Math.floor(a);
        this.r = (a >> 16 & 255) / 255;
        this.g = (a >> 8 & 255) / 255;
        this.b = (a & 255) / 255;
        return this
    },
    setRGB: function(d, c, a) {
        this.r = d;
        this.g = c;
        this.b = a;
        return this
    },
    setHSL: function(d, c, b) {
        if (c === 0) {
            this.r = this.g = this.b = b
        } else {
            var a = function(i, h, g) {
                if (g < 0) {
                    g += 1
                }
                if (g > 1) {
                    g -= 1
                }
                if (g < 1 / 6) {
                    return i + (h - i) * 6 * g
                }
                if (g < 1 / 2) {
                    return h
                }
                if (g < 2 / 3) {
                    return i + (h - i) * 6 * (2 / 3 - g)
                }
                return i
            };
            var f = b <= 0.5 ? b * (1 + c) : b + c - (b * c);
            var e = (2 * b) - f;
            this.r = a(e, f, d + 1 / 3);
            this.g = a(e, f, d);
            this.b = a(e, f, d - 1 / 3)
        }
        return this
    },
    setStyle: function(b) {
        if (/^rgb\((\d+), ?(\d+), ?(\d+)\)$/i.test(b)) {
            var a = /^rgb\((\d+), ?(\d+), ?(\d+)\)$/i.exec(b);
            this.r = Math.min(255, parseInt(a[1], 10)) / 255;
            this.g = Math.min(255, parseInt(a[2], 10)) / 255;
            this.b = Math.min(255, parseInt(a[3], 10)) / 255;
            return this
        }
        if (/^rgb\((\d+)\%, ?(\d+)\%, ?(\d+)\%\)$/i.test(b)) {
            var a = /^rgb\((\d+)\%, ?(\d+)\%, ?(\d+)\%\)$/i.exec(b);
            this.r = Math.min(100, parseInt(a[1], 10)) / 100;
            this.g = Math.min(100, parseInt(a[2], 10)) / 100;
            this.b = Math.min(100, parseInt(a[3], 10)) / 100;
            return this
        }
        if (/^\#([0-9a-f]{6})$/i.test(b)) {
            var a = /^\#([0-9a-f]{6})$/i.exec(b);
            this.setHex(parseInt(a[1], 16));
            return this
        }
        if (/^\#([0-9a-f])([0-9a-f])([0-9a-f])$/i.test(b)) {
            var a = /^\#([0-9a-f])([0-9a-f])([0-9a-f])$/i.exec(b);
            this.setHex(parseInt(a[1] + a[1] + a[2] + a[2] + a[3] + a[3], 16));
            return this
        }
        if (/^(\w+)$/i.test(b)) {
            this.setHex(THREE.ColorKeywords[b]);
            return this
        }
    },
    copy: function(a) {
        this.r = a.r;
        this.g = a.g;
        this.b = a.b;
        return this
    },
    copyGammaToLinear: function(a) {
        this.r = a.r * a.r;
        this.g = a.g * a.g;
        this.b = a.b * a.b;
        return this
    },
    copyLinearToGamma: function(a) {
        this.r = Math.sqrt(a.r);
        this.g = Math.sqrt(a.g);
        this.b = Math.sqrt(a.b);
        return this
    },
    convertGammaToLinear: function() {
        var d = this.r,
            c = this.g,
            a = this.b;
        this.r = d * d;
        this.g = c * c;
        this.b = a * a;
        return this
    },
    convertLinearToGamma: function() {
        this.r = Math.sqrt(this.r);
        this.g = Math.sqrt(this.g);
        this.b = Math.sqrt(this.b);
        return this
    },
    getHex: function() {
        return (this.r * 255) << 16 ^ (this.g * 255) << 8 ^ (this.b * 255) << 0
    },
    getHexString: function() {
        return ("000000" + this.getHex().toString(16)).slice(-6)
    },
    getHSL: function(m) {
        var l = m || {
            h: 0,
            s: 0,
            l: 0
        };
        var a = this.r,
            e = this.g,
            h = this.b;
        var i = Math.max(a, e, h);
        var c = Math.min(a, e, h);
        var f, d;
        var k = (c + i) / 2;
        if (c === i) {
            f = 0;
            d = 0
        } else {
            var j = i - c;
            d = k <= 0.5 ? j / (i + c) : j / (2 - i - c);
            switch (i) {
                case a:
                    f = (e - h) / j + (e < h ? 6 : 0);
                    break;
                case e:
                    f = (h - a) / j + 2;
                    break;
                case h:
                    f = (a - e) / j + 4;
                    break
            }
            f /= 6
        }
        l.h = f;
        l.s = d;
        l.l = k;
        return l
    },
    getStyle: function() {
        return "rgb(" + ((this.r * 255) | 0) + "," + ((this.g * 255) | 0) + "," + ((this.b * 255) | 0) + ")"
    },
    offsetHSL: function(d, c, a) {
        var b = this.getHSL();
        b.h += d;
        b.s += c;
        b.l += a;
        this.setHSL(b.h, b.s, b.l);
        return this
    },
    add: function(a) {
        this.r += a.r;
        this.g += a.g;
        this.b += a.b;
        return this
    },
    addColors: function(b, a) {
        this.r = b.r + a.r;
        this.g = b.g + a.g;
        this.b = b.b + a.b;
        return this
    },
    addScalar: function(a) {
        this.r += a;
        this.g += a;
        this.b += a;
        return this
    },
    multiply: function(a) {
        this.r *= a.r;
        this.g *= a.g;
        this.b *= a.b;
        return this
    },
    multiplyScalar: function(a) {
        this.r *= a;
        this.g *= a;
        this.b *= a;
        return this
    },
    lerp: function(a, b) {
        this.r += (a.r - this.r) * b;
        this.g += (a.g - this.g) * b;
        this.b += (a.b - this.b) * b;
        return this
    },
    equals: function(a) {
        return (a.r === this.r) && (a.g === this.g) && (a.b === this.b)
    },
    fromArray: function(a) {
        this.r = a[0];
        this.g = a[1];
        this.b = a[2];
        return this
    },
    toArray: function() {
        return [this.r, this.g, this.b]
    },
    clone: function() {
        return new THREE.Color().setRGB(this.r, this.g, this.b)
    }
};
THREE.ColorKeywords = {
    aliceblue: 15792383,
    antiquewhite: 16444375,
    aqua: 65535,
    aquamarine: 8388564,
    azure: 15794175,
    beige: 16119260,
    bisque: 16770244,
    black: 0,
    blanchedalmond: 16772045,
    blue: 255,
    blueviolet: 9055202,
    brown: 10824234,
    burlywood: 14596231,
    cadetblue: 6266528,
    chartreuse: 8388352,
    chocolate: 13789470,
    coral: 16744272,
    cornflowerblue: 6591981,
    cornsilk: 16775388,
    crimson: 14423100,
    cyan: 65535,
    darkblue: 139,
    darkcyan: 35723,
    darkgoldenrod: 12092939,
    darkgray: 11119017,
    darkgreen: 25600,
    darkgrey: 11119017,
    darkkhaki: 12433259,
    darkmagenta: 9109643,
    darkolivegreen: 5597999,
    darkorange: 16747520,
    darkorchid: 10040012,
    darkred: 9109504,
    darksalmon: 15308410,
    darkseagreen: 9419919,
    darkslateblue: 4734347,
    darkslategray: 3100495,
    darkslategrey: 3100495,
    darkturquoise: 52945,
    darkviolet: 9699539,
    deeppink: 16716947,
    deepskyblue: 49151,
    dimgray: 6908265,
    dimgrey: 6908265,
    dodgerblue: 2003199,
    firebrick: 11674146,
    floralwhite: 16775920,
    forestgreen: 2263842,
    fuchsia: 16711935,
    gainsboro: 14474460,
    ghostwhite: 16316671,
    gold: 16766720,
    goldenrod: 14329120,
    gray: 8421504,
    green: 32768,
    greenyellow: 11403055,
    grey: 8421504,
    honeydew: 15794160,
    hotpink: 16738740,
    indianred: 13458524,
    indigo: 4915330,
    ivory: 16777200,
    khaki: 15787660,
    lavender: 15132410,
    lavenderblush: 16773365,
    lawngreen: 8190976,
    lemonchiffon: 16775885,
    lightblue: 11393254,
    lightcoral: 15761536,
    lightcyan: 14745599,
    lightgoldenrodyellow: 16448210,
    lightgray: 13882323,
    lightgreen: 9498256,
    lightgrey: 13882323,
    lightpink: 16758465,
    lightsalmon: 16752762,
    lightseagreen: 2142890,
    lightskyblue: 8900346,
    lightslategray: 7833753,
    lightslategrey: 7833753,
    lightsteelblue: 11584734,
    lightyellow: 16777184,
    lime: 65280,
    limegreen: 3329330,
    linen: 16445670,
    magenta: 16711935,
    maroon: 8388608,
    mediumaquamarine: 6737322,
    mediumblue: 205,
    mediumorchid: 12211667,
    mediumpurple: 9662683,
    mediumseagreen: 3978097,
    mediumslateblue: 8087790,
    mediumspringgreen: 64154,
    mediumturquoise: 4772300,
    mediumvioletred: 13047173,
    midnightblue: 1644912,
    mintcream: 16121850,
    mistyrose: 16770273,
    moccasin: 16770229,
    navajowhite: 16768685,
    navy: 128,
    oldlace: 16643558,
    olive: 8421376,
    olivedrab: 7048739,
    orange: 16753920,
    orangered: 16729344,
    orchid: 14315734,
    palegoldenrod: 15657130,
    palegreen: 10025880,
    paleturquoise: 11529966,
    palevioletred: 14381203,
    papayawhip: 16773077,
    peachpuff: 16767673,
    peru: 13468991,
    pink: 16761035,
    plum: 14524637,
    powderblue: 11591910,
    purple: 8388736,
    red: 16711680,
    rosybrown: 12357519,
    royalblue: 4286945,
    saddlebrown: 9127187,
    salmon: 16416882,
    sandybrown: 16032864,
    seagreen: 3050327,
    seashell: 16774638,
    sienna: 10506797,
    silver: 12632256,
    skyblue: 8900331,
    slateblue: 6970061,
    slategray: 7372944,
    slategrey: 7372944,
    snow: 16775930,
    springgreen: 65407,
    steelblue: 4620980,
    tan: 13808780,
    teal: 32896,
    thistle: 14204888,
    tomato: 16737095,
    turquoise: 4251856,
    violet: 15631086,
    wheat: 16113331,
    white: 16777215,
    whitesmoke: 16119285,
    yellow: 16776960,
    yellowgreen: 10145074
};
THREE.Quaternion = function(a, d, c, b) {
    this._x = a || 0;
    this._y = d || 0;
    this._z = c || 0;
    this._w = (b !== undefined) ? b : 1
};
THREE.Quaternion.prototype = {
    constructor: THREE.Quaternion,
    _x: 0,
    _y: 0,
    _z: 0,
    _w: 0,
    get x() {
        return this._x
    },
    set x(a) {
        this._x = a;
        this.onChangeCallback()
    },
    get y() {
        return this._y
    },
    set y(a) {
        this._y = a;
        this.onChangeCallback()
    },
    get z() {
        return this._z
    },
    set z(a) {
        this._z = a;
        this.onChangeCallback()
    },
    get w() {
        return this._w
    },
    set w(a) {
        this._w = a;
        this.onChangeCallback()
    },
    set: function(a, d, c, b) {
        this._x = a;
        this._y = d;
        this._z = c;
        this._w = b;
        this.onChangeCallback();
        return this
    },
    copy: function(a) {
        this._x = a.x;
        this._y = a.y;
        this._z = a.z;
        this._w = a.w;
        this.onChangeCallback();
        return this
    },
    setFromEuler: function(g, h) {
        if (g instanceof THREE.Euler === false) {
            throw new Error("THREE.Quaternion: .setFromEuler() now expects a Euler rotation rather than a Vector3 and order.")
        }
        var f = Math.cos(g._x / 2);
        var e = Math.cos(g._y / 2);
        var c = Math.cos(g._z / 2);
        var d = Math.sin(g._x / 2);
        var b = Math.sin(g._y / 2);
        var a = Math.sin(g._z / 2);
        if (g.order === "XYZ") {
            this._x = d * e * c + f * b * a;
            this._y = f * b * c - d * e * a;
            this._z = f * e * a + d * b * c;
            this._w = f * e * c - d * b * a
        } else {
            if (g.order === "YXZ") {
                this._x = d * e * c + f * b * a;
                this._y = f * b * c - d * e * a;
                this._z = f * e * a - d * b * c;
                this._w = f * e * c + d * b * a
            } else {
                if (g.order === "ZXY") {
                    this._x = d * e * c - f * b * a;
                    this._y = f * b * c + d * e * a;
                    this._z = f * e * a + d * b * c;
                    this._w = f * e * c - d * b * a
                } else {
                    if (g.order === "ZYX") {
                        this._x = d * e * c - f * b * a;
                        this._y = f * b * c + d * e * a;
                        this._z = f * e * a - d * b * c;
                        this._w = f * e * c + d * b * a
                    } else {
                        if (g.order === "YZX") {
                            this._x = d * e * c + f * b * a;
                            this._y = f * b * c + d * e * a;
                            this._z = f * e * a - d * b * c;
                            this._w = f * e * c - d * b * a
                        } else {
                            if (g.order === "XZY") {
                                this._x = d * e * c - f * b * a;
                                this._y = f * b * c - d * e * a;
                                this._z = f * e * a + d * b * c;
                                this._w = f * e * c + d * b * a
                            }
                        }
                    }
                }
            }
        }
        if (h !== false) {
            this.onChangeCallback()
        }
        return this
    },
    setFromAxisAngle: function(c, d) {
        var a = d / 2,
            b = Math.sin(a);
        this._x = c.x * b;
        this._y = c.y * b;
        this._z = c.z * b;
        this._w = Math.cos(a);
        this.onChangeCallback();
        return this
    },
    setFromRotationMatrix: function(e) {
        var d = e.elements,
            i = d[0],
            h = d[4],
            g = d[8],
            c = d[1],
            b = d[5],
            a = d[9],
            l = d[2],
            k = d[6],
            j = d[10],
            f = i + b + j,
            n;
        if (f > 0) {
            n = 0.5 / Math.sqrt(f + 1);
            this._w = 0.25 / n;
            this._x = (k - a) * n;
            this._y = (g - l) * n;
            this._z = (c - h) * n
        } else {
            if (i > b && i > j) {
                n = 2 * Math.sqrt(1 + i - b - j);
                this._w = (k - a) / n;
                this._x = 0.25 * n;
                this._y = (h + c) / n;
                this._z = (g + l) / n
            } else {
                if (b > j) {
                    n = 2 * Math.sqrt(1 + b - i - j);
                    this._w = (g - l) / n;
                    this._x = (h + c) / n;
                    this._y = 0.25 * n;
                    this._z = (a + k) / n
                } else {
                    n = 2 * Math.sqrt(1 + j - i - b);
                    this._w = (c - h) / n;
                    this._x = (g + l) / n;
                    this._y = (a + k) / n;
                    this._z = 0.25 * n
                }
            }
        }
        this.onChangeCallback();
        return this
    },
    setFromUnitVectors: function() {
        var c, a;
        var b = 0.000001;
        return function(d, e) {
            if (c === undefined) {
                c = new THREE.Vector3()
            }
            a = d.dot(e) + 1;
            if (a < b) {
                a = 0;
                if (Math.abs(d.x) > Math.abs(d.z)) {
                    c.set(-d.y, d.x, 0)
                } else {
                    c.set(0, -d.z, d.y)
                }
            } else {
                c.crossVectors(d, e)
            }
            this._x = c.x;
            this._y = c.y;
            this._z = c.z;
            this._w = a;
            this.normalize();
            return this
        }
    }(),
    inverse: function() {
        this.conjugate().normalize();
        return this
    },
    conjugate: function() {
        this._x *= -1;
        this._y *= -1;
        this._z *= -1;
        this.onChangeCallback();
        return this
    },
    dot: function(a) {
        return this._x * a._x + this._y * a._y + this._z * a._z + this._w * a._w
    },
    lengthSq: function() {
        return this._x * this._x + this._y * this._y + this._z * this._z + this._w * this._w
    },
    length: function() {
        return Math.sqrt(this._x * this._x + this._y * this._y + this._z * this._z + this._w * this._w)
    },
    normalize: function() {
        var a = this.length();
        if (a === 0) {
            this._x = 0;
            this._y = 0;
            this._z = 0;
            this._w = 1
        } else {
            a = 1 / a;
            this._x = this._x * a;
            this._y = this._y * a;
            this._z = this._z * a;
            this._w = this._w * a
        }
        this.onChangeCallback();
        return this
    },
    multiply: function(a, b) {
        if (b !== undefined) {
            console.warn("THREE.Quaternion: .multiply() now only accepts one argument. Use .multiplyQuaternions( a, b ) instead.");
            return this.multiplyQuaternions(a, b)
        }
        return this.multiplyQuaternions(this, a)
    },
    multiplyQuaternions: function(l, k) {
        var i = l._x,
            h = l._y,
            g = l._z,
            j = l._w;
        var e = k._x,
            d = k._y,
            c = k._z,
            f = k._w;
        this._x = i * f + j * e + h * c - g * d;
        this._y = h * f + j * d + g * e - i * c;
        this._z = g * f + j * c + i * d - h * e;
        this._w = j * f - i * e - h * d - g * c;
        this.onChangeCallback();
        return this
    },
    multiplyVector3: function(a) {
        console.warn("THREE.Quaternion: .multiplyVector3() has been removed. Use is now vector.applyQuaternion( quaternion ) instead.");
        return a.applyQuaternion(this)
    },
    slerp: function(c, k) {
        if (k === 0) {
            return this
        }
        if (k === 1) {
            return this.copy(c)
        }
        var i = this._x,
            h = this._y,
            g = this._z,
            j = this._w;
        var b = j * c._w + i * c._x + h * c._y + g * c._z;
        if (b < 0) {
            this._w = -c._w;
            this._x = -c._x;
            this._y = -c._y;
            this._z = -c._z;
            b = -b
        } else {
            this.copy(c)
        }
        if (b >= 1) {
            this._w = j;
            this._x = i;
            this._y = h;
            this._z = g;
            return this
        }
        var d = Math.acos(b);
        var a = Math.sqrt(1 - b * b);
        if (Math.abs(a) < 0.001) {
            this._w = 0.5 * (j + this._w);
            this._x = 0.5 * (i + this._x);
            this._y = 0.5 * (h + this._y);
            this._z = 0.5 * (g + this._z);
            return this
        }
        var f = Math.sin((1 - k) * d) / a,
            e = Math.sin(k * d) / a;
        this._w = (j * f + this._w * e);
        this._x = (i * f + this._x * e);
        this._y = (h * f + this._y * e);
        this._z = (g * f + this._z * e);
        this.onChangeCallback();
        return this
    },
    equals: function(a) {
        return (a._x === this._x) && (a._y === this._y) && (a._z === this._z) && (a._w === this._w)
    },
    fromArray: function(b, a) {
        if (a === undefined) {
            a = 0
        }
        this._x = b[a];
        this._y = b[a + 1];
        this._z = b[a + 2];
        this._w = b[a + 3];
        this.onChangeCallback();
        return this
    },
    toArray: function(b, a) {
        if (b === undefined) {
            b = []
        }
        if (a === undefined) {
            a = 0
        }
        b[a] = this._x;
        b[a + 1] = this._y;
        b[a + 2] = this._z;
        b[a + 3] = this._w;
        return b
    },
    onChange: function(a) {
        this.onChangeCallback = a;
        return this
    },
    onChangeCallback: function() {},
    clone: function() {
        return new THREE.Quaternion(this._x, this._y, this._z, this._w)
    }
};
THREE.Quaternion.slerp = function(d, c, b, a) {
    return b.copy(d).slerp(c, a)
};
THREE.Vector2 = function(a, b) {
    this.x = a || 0;
    this.y = b || 0
};
THREE.Vector2.prototype = {
    constructor: THREE.Vector2,
    set: function(a, b) {
        this.x = a;
        this.y = b;
        return this
    },
    setX: function(a) {
        this.x = a;
        return this
    },
    setY: function(a) {
        this.y = a;
        return this
    },
    setComponent: function(a, b) {
        switch (a) {
            case 0:
                this.x = b;
                break;
            case 1:
                this.y = b;
                break;
            default:
                throw new Error("index is out of range: " + a)
        }
    },
    getComponent: function(a) {
        switch (a) {
            case 0:
                return this.x;
            case 1:
                return this.y;
            default:
                throw new Error("index is out of range: " + a)
        }
    },
    copy: function(a) {
        this.x = a.x;
        this.y = a.y;
        return this
    },
    add: function(b, a) {
        if (a !== undefined) {
            console.warn("THREE.Vector2: .add() now only accepts one argument. Use .addVectors( a, b ) instead.");
            return this.addVectors(b, a)
        }
        this.x += b.x;
        this.y += b.y;
        return this
    },
    addVectors: function(d, c) {
        this.x = d.x + c.x;
        this.y = d.y + c.y;
        return this
    },
    addScalar: function(a) {
        this.x += a;
        this.y += a;
        return this
    },
    sub: function(b, a) {
        if (a !== undefined) {
            console.warn("THREE.Vector2: .sub() now only accepts one argument. Use .subVectors( a, b ) instead.");
            return this.subVectors(b, a)
        }
        this.x -= b.x;
        this.y -= b.y;
        return this
    },
    subVectors: function(d, c) {
        this.x = d.x - c.x;
        this.y = d.y - c.y;
        return this
    },
    multiply: function(a) {
        this.x *= a.x;
        this.y *= a.y;
        return this
    },
    multiplyScalar: function(a) {
        this.x *= a;
        this.y *= a;
        return this
    },
    divide: function(a) {
        this.x /= a.x;
        this.y /= a.y;
        return this
    },
    divideScalar: function(b) {
        if (b !== 0) {
            var a = 1 / b;
            this.x *= a;
            this.y *= a
        } else {
            this.x = 0;
            this.y = 0
        }
        return this
    },
    min: function(a) {
        if (this.x > a.x) {
            this.x = a.x
        }
        if (this.y > a.y) {
            this.y = a.y
        }
        return this
    },
    max: function(a) {
        if (this.x < a.x) {
            this.x = a.x
        }
        if (this.y < a.y) {
            this.y = a.y
        }
        return this
    },
    clamp: function(b, a) {
        if (this.x < b.x) {
            this.x = b.x
        } else {
            if (this.x > a.x) {
                this.x = a.x
            }
        }
        if (this.y < b.y) {
            this.y = b.y
        } else {
            if (this.y > a.y) {
                this.y = a.y
            }
        }
        return this
    },
    clampScalar: (function() {
        var b, a;
        return function(c, d) {
            if (b === undefined) {
                b = new THREE.Vector2();
                a = new THREE.Vector2()
            }
            b.set(c, c);
            a.set(d, d);
            return this.clamp(b, a)
        }
    })(),
    floor: function() {
        this.x = Math.floor(this.x);
        this.y = Math.floor(this.y);
        return this
    },
    ceil: function() {
        this.x = Math.ceil(this.x);
        this.y = Math.ceil(this.y);
        return this
    },
    round: function() {
        this.x = Math.round(this.x);
        this.y = Math.round(this.y);
        return this
    },
    roundToZero: function() {
        this.x = (this.x < 0) ? Math.ceil(this.x) : Math.floor(this.x);
        this.y = (this.y < 0) ? Math.ceil(this.y) : Math.floor(this.y);
        return this
    },
    negate: function() {
        this.x = -this.x;
        this.y = -this.y;
        return this
    },
    dot: function(a) {
        return this.x * a.x + this.y * a.y
    },
    lengthSq: function() {
        return this.x * this.x + this.y * this.y
    },
    length: function() {
        return Math.sqrt(this.x * this.x + this.y * this.y)
    },
    normalize: function() {
        return this.divideScalar(this.length())
    },
    distanceTo: function(a) {
        return Math.sqrt(this.distanceToSquared(a))
    },
    distanceToSquared: function(c) {
        var b = this.x - c.x,
            a = this.y - c.y;
        return b * b + a * a
    },
    setLength: function(a) {
        var b = this.length();
        if (b !== 0 && a !== b) {
            this.multiplyScalar(a / b)
        }
        return this
    },
    lerp: function(a, b) {
        this.x += (a.x - this.x) * b;
        this.y += (a.y - this.y) * b;
        return this
    },
    equals: function(a) {
        return ((a.x === this.x) && (a.y === this.y))
    },
    fromArray: function(b, a) {
        if (a === undefined) {
            a = 0
        }
        this.x = b[a];
        this.y = b[a + 1];
        return this
    },
    toArray: function(b, a) {
        if (b === undefined) {
            b = []
        }
        if (a === undefined) {
            a = 0
        }
        b[a] = this.x;
        b[a + 1] = this.y;
        return b
    },
    fromAttribute: function(b, a, c) {
        if (c === undefined) {
            c = 0
        }
        a = a * b.itemSize + c;
        this.x = b.array[a];
        this.y = b.array[a + 1];
        return this
    },
    clone: function() {
        return new THREE.Vector2(this.x, this.y)
    }
};
THREE.Vector3 = function(a, c, b) {
    this.x = a || 0;
    this.y = c || 0;
    this.z = b || 0
};
THREE.Vector3.prototype = {
    constructor: THREE.Vector3,
    set: function(a, c, b) {
        this.x = a;
        this.y = c;
        this.z = b;
        return this
    },
    setX: function(a) {
        this.x = a;
        return this
    },
    setY: function(a) {
        this.y = a;
        return this
    },
    setZ: function(a) {
        this.z = a;
        return this
    },
    setComponent: function(a, b) {
        switch (a) {
            case 0:
                this.x = b;
                break;
            case 1:
                this.y = b;
                break;
            case 2:
                this.z = b;
                break;
            default:
                throw new Error("index is out of range: " + a)
        }
    },
    getComponent: function(a) {
        switch (a) {
            case 0:
                return this.x;
            case 1:
                return this.y;
            case 2:
                return this.z;
            default:
                throw new Error("index is out of range: " + a)
        }
    },
    copy: function(a) {
        this.x = a.x;
        this.y = a.y;
        this.z = a.z;
        return this
    },
    add: function(b, a) {
        if (a !== undefined) {
            console.warn("THREE.Vector3: .add() now only accepts one argument. Use .addVectors( a, b ) instead.");
            return this.addVectors(b, a)
        }
        this.x += b.x;
        this.y += b.y;
        this.z += b.z;
        return this
    },
    addScalar: function(a) {
        this.x += a;
        this.y += a;
        this.z += a;
        return this
    },
    addVectors: function(d, c) {
        this.x = d.x + c.x;
        this.y = d.y + c.y;
        this.z = d.z + c.z;
        return this
    },
    sub: function(b, a) {
        if (a !== undefined) {
            console.warn("THREE.Vector3: .sub() now only accepts one argument. Use .subVectors( a, b ) instead.");
            return this.subVectors(b, a)
        }
        this.x -= b.x;
        this.y -= b.y;
        this.z -= b.z;
        return this
    },
    subVectors: function(d, c) {
        this.x = d.x - c.x;
        this.y = d.y - c.y;
        this.z = d.z - c.z;
        return this
    },
    multiply: function(b, a) {
        if (a !== undefined) {
            console.warn("THREE.Vector3: .multiply() now only accepts one argument. Use .multiplyVectors( a, b ) instead.");
            return this.multiplyVectors(b, a)
        }
        this.x *= b.x;
        this.y *= b.y;
        this.z *= b.z;
        return this
    },
    multiplyScalar: function(a) {
        this.x *= a;
        this.y *= a;
        this.z *= a;
        return this
    },
    multiplyVectors: function(d, c) {
        this.x = d.x * c.x;
        this.y = d.y * c.y;
        this.z = d.z * c.z;
        return this
    },
    applyEuler: function() {
        var a;
        return function(b) {
            if (b instanceof THREE.Euler === false) {
                console.error("THREE.Vector3: .applyEuler() now expects a Euler rotation rather than a Vector3 and order.")
            }
            if (a === undefined) {
                a = new THREE.Quaternion()
            }
            this.applyQuaternion(a.setFromEuler(b));
            return this
        }
    }(),
    applyAxisAngle: function() {
        var a;
        return function(b, c) {
            if (a === undefined) {
                a = new THREE.Quaternion()
            }
            this.applyQuaternion(a.setFromAxisAngle(b, c));
            return this
        }
    }(),
    applyMatrix3: function(b) {
        var a = this.x;
        var f = this.y;
        var d = this.z;
        var c = b.elements;
        this.x = c[0] * a + c[3] * f + c[6] * d;
        this.y = c[1] * a + c[4] * f + c[7] * d;
        this.z = c[2] * a + c[5] * f + c[8] * d;
        return this
    },
    applyMatrix4: function(b) {
        var a = this.x,
            f = this.y,
            d = this.z;
        var c = b.elements;
        this.x = c[0] * a + c[4] * f + c[8] * d + c[12];
        this.y = c[1] * a + c[5] * f + c[9] * d + c[13];
        this.z = c[2] * a + c[6] * f + c[10] * d + c[14];
        return this
    },
    applyProjection: function(b) {
        var a = this.x,
            h = this.y,
            g = this.z;
        var c = b.elements;
        var f = 1 / (c[3] * a + c[7] * h + c[11] * g + c[15]);
        this.x = (c[0] * a + c[4] * h + c[8] * g + c[12]) * f;
        this.y = (c[1] * a + c[5] * h + c[9] * g + c[13]) * f;
        this.z = (c[2] * a + c[6] * h + c[10] * g + c[14]) * f;
        return this
    },
    applyQuaternion: function(a) {
        var l = this.x;
        var k = this.y;
        var j = this.z;
        var h = a.x;
        var g = a.y;
        var f = a.z;
        var i = a.w;
        var d = i * l + g * j - f * k;
        var c = i * k + f * l - h * j;
        var b = i * j + h * k - g * l;
        var e = -h * l - g * k - f * j;
        this.x = d * i + e * -h + c * -f - b * -g;
        this.y = c * i + e * -g + b * -h - d * -f;
        this.z = b * i + e * -f + d * -g - c * -h;
        return this
    },
    project: function() {
        var a;
        return function(b) {
            if (a === undefined) {
                a = new THREE.Matrix4()
            }
            a.multiplyMatrices(b.projectionMatrix, a.getInverse(b.matrixWorld));
            return this.applyProjection(a)
        }
    }(),
    unproject: function() {
        var a;
        return function(b) {
            if (a === undefined) {
                a = new THREE.Matrix4()
            }
            a.multiplyMatrices(b.matrixWorld, a.getInverse(b.projectionMatrix));
            return this.applyProjection(a)
        }
    }(),
    transformDirection: function(b) {
        var a = this.x,
            f = this.y,
            d = this.z;
        var c = b.elements;
        this.x = c[0] * a + c[4] * f + c[8] * d;
        this.y = c[1] * a + c[5] * f + c[9] * d;
        this.z = c[2] * a + c[6] * f + c[10] * d;
        this.normalize();
        return this
    },
    divide: function(a) {
        this.x /= a.x;
        this.y /= a.y;
        this.z /= a.z;
        return this
    },
    divideScalar: function(b) {
        if (b !== 0) {
            var a = 1 / b;
            this.x *= a;
            this.y *= a;
            this.z *= a
        } else {
            this.x = 0;
            this.y = 0;
            this.z = 0
        }
        return this
    },
    min: function(a) {
        if (this.x > a.x) {
            this.x = a.x
        }
        if (this.y > a.y) {
            this.y = a.y
        }
        if (this.z > a.z) {
            this.z = a.z
        }
        return this
    },
    max: function(a) {
        if (this.x < a.x) {
            this.x = a.x
        }
        if (this.y < a.y) {
            this.y = a.y
        }
        if (this.z < a.z) {
            this.z = a.z
        }
        return this
    },
    clamp: function(b, a) {
        if (this.x < b.x) {
            this.x = b.x
        } else {
            if (this.x > a.x) {
                this.x = a.x
            }
        }
        if (this.y < b.y) {
            this.y = b.y
        } else {
            if (this.y > a.y) {
                this.y = a.y
            }
        }
        if (this.z < b.z) {
            this.z = b.z
        } else {
            if (this.z > a.z) {
                this.z = a.z
            }
        }
        return this
    },
    clampScalar: (function() {
        var b, a;
        return function(c, d) {
            if (b === undefined) {
                b = new THREE.Vector3();
                a = new THREE.Vector3()
            }
            b.set(c, c, c);
            a.set(d, d, d);
            return this.clamp(b, a)
        }
    })(),
    floor: function() {
        this.x = Math.floor(this.x);
        this.y = Math.floor(this.y);
        this.z = Math.floor(this.z);
        return this
    },
    ceil: function() {
        this.x = Math.ceil(this.x);
        this.y = Math.ceil(this.y);
        this.z = Math.ceil(this.z);
        return this
    },
    round: function() {
        this.x = Math.round(this.x);
        this.y = Math.round(this.y);
        this.z = Math.round(this.z);
        return this
    },
    roundToZero: function() {
        this.x = (this.x < 0) ? Math.ceil(this.x) : Math.floor(this.x);
        this.y = (this.y < 0) ? Math.ceil(this.y) : Math.floor(this.y);
        this.z = (this.z < 0) ? Math.ceil(this.z) : Math.floor(this.z);
        return this
    },
    negate: function() {
        this.x = -this.x;
        this.y = -this.y;
        this.z = -this.z;
        return this
    },
    dot: function(a) {
        return this.x * a.x + this.y * a.y + this.z * a.z
    },
    lengthSq: function() {
        return this.x * this.x + this.y * this.y + this.z * this.z
    },
    length: function() {
        return Math.sqrt(this.x * this.x + this.y * this.y + this.z * this.z)
    },
    lengthManhattan: function() {
        return Math.abs(this.x) + Math.abs(this.y) + Math.abs(this.z)
    },
    normalize: function() {
        return this.divideScalar(this.length())
    },
    setLength: function(a) {
        var b = this.length();
        if (b !== 0 && a !== b) {
            this.multiplyScalar(a / b)
        }
        return this
    },
    lerp: function(a, b) {
        this.x += (a.x - this.x) * b;
        this.y += (a.y - this.y) * b;
        this.z += (a.z - this.z) * b;
        return this
    },
    cross: function(c, b) {
        if (b !== undefined) {
            console.warn("THREE.Vector3: .cross() now only accepts one argument. Use .crossVectors( a, b ) instead.");
            return this.crossVectors(c, b)
        }
        var a = this.x,
            e = this.y,
            d = this.z;
        this.x = e * c.z - d * c.y;
        this.y = d * c.x - a * c.z;
        this.z = a * c.y - e * c.x;
        return this
    },
    crossVectors: function(d, c) {
        var h = d.x,
            f = d.y,
            e = d.z;
        var j = c.x,
            i = c.y,
            g = c.z;
        this.x = f * g - e * i;
        this.y = e * j - h * g;
        this.z = h * i - f * j;
        return this
    },
    projectOnVector: function() {
        var b, a;
        return function(c) {
            if (b === undefined) {
                b = new THREE.Vector3()
            }
            b.copy(c).normalize();
            a = this.dot(b);
            return this.copy(b).multiplyScalar(a)
        }
    }(),
    projectOnPlane: function() {
        var a;
        return function(b) {
            if (a === undefined) {
                a = new THREE.Vector3()
            }
            a.copy(this).projectOnVector(b);
            return this.sub(a)
        }
    }(),
    reflect: function() {
        var a;
        return function(b) {
            if (a === undefined) {
                a = new THREE.Vector3()
            }
            return this.sub(a.copy(b).multiplyScalar(2 * this.dot(b)))
        }
    }(),
    angleTo: function(a) {
        var b = this.dot(a) / (this.length() * a.length());
        return Math.acos(THREE.Math.clamp(b, -1, 1))
    },
    distanceTo: function(a) {
        return Math.sqrt(this.distanceToSquared(a))
    },
    distanceToSquared: function(d) {
        var c = this.x - d.x;
        var b = this.y - d.y;
        var a = this.z - d.z;
        return c * c + b * b + a * a
    },
    setEulerFromRotationMatrix: function(b, a) {
        console.error("THREE.Vector3: .setEulerFromRotationMatrix() has been removed. Use Euler.setFromRotationMatrix() instead.")
    },
    setEulerFromQuaternion: function(b, a) {
        console.error("THREE.Vector3: .setEulerFromQuaternion() has been removed. Use Euler.setFromQuaternion() instead.")
    },
    getPositionFromMatrix: function(a) {
        console.warn("THREE.Vector3: .getPositionFromMatrix() has been renamed to .setFromMatrixPosition().");
        return this.setFromMatrixPosition(a)
    },
    getScaleFromMatrix: function(a) {
        console.warn("THREE.Vector3: .getScaleFromMatrix() has been renamed to .setFromMatrixScale().");
        return this.setFromMatrixScale(a)
    },
    getColumnFromMatrix: function(b, a) {
        console.warn("THREE.Vector3: .getColumnFromMatrix() has been renamed to .setFromMatrixColumn().");
        return this.setFromMatrixColumn(b, a)
    },
    setFromMatrixPosition: function(a) {
        this.x = a.elements[12];
        this.y = a.elements[13];
        this.z = a.elements[14];
        return this
    },
    setFromMatrixScale: function(a) {
        var d = this.set(a.elements[0], a.elements[1], a.elements[2]).length();
        var c = this.set(a.elements[4], a.elements[5], a.elements[6]).length();
        var b = this.set(a.elements[8], a.elements[9], a.elements[10]).length();
        this.x = d;
        this.y = c;
        this.z = b;
        return this
    },
    setFromMatrixColumn: function(b, a) {
        var d = b * 4;
        var c = a.elements;
        this.x = c[d];
        this.y = c[d + 1];
        this.z = c[d + 2];
        return this
    },
    equals: function(a) {
        return ((a.x === this.x) && (a.y === this.y) && (a.z === this.z))
    },
    fromArray: function(b, a) {
        if (a === undefined) {
            a = 0
        }
        this.x = b[a];
        this.y = b[a + 1];
        this.z = b[a + 2];
        return this
    },
    toArray: function(b, a) {
        if (b === undefined) {
            b = []
        }
        if (a === undefined) {
            a = 0
        }
        b[a] = this.x;
        b[a + 1] = this.y;
        b[a + 2] = this.z;
        return b
    },
    fromAttribute: function(b, a, c) {
        if (c === undefined) {
            c = 0
        }
        a = a * b.itemSize + c;
        this.x = b.array[a];
        this.y = b.array[a + 1];
        this.z = b.array[a + 2];
        return this
    },
    clone: function() {
        return new THREE.Vector3(this.x, this.y, this.z)
    }
};
THREE.Vector4 = function(a, d, c, b) {
    this.x = a || 0;
    this.y = d || 0;
    this.z = c || 0;
    this.w = (b !== undefined) ? b : 1
};
THREE.Vector4.prototype = {
    constructor: THREE.Vector4,
    set: function(a, d, c, b) {
        this.x = a;
        this.y = d;
        this.z = c;
        this.w = b;
        return this
    },
    setX: function(a) {
        this.x = a;
        return this
    },
    setY: function(a) {
        this.y = a;
        return this
    },
    setZ: function(a) {
        this.z = a;
        return this
    },
    setW: function(a) {
        this.w = a;
        return this
    },
    setComponent: function(a, b) {
        switch (a) {
            case 0:
                this.x = b;
                break;
            case 1:
                this.y = b;
                break;
            case 2:
                this.z = b;
                break;
            case 3:
                this.w = b;
                break;
            default:
                throw new Error("index is out of range: " + a)
        }
    },
    getComponent: function(a) {
        switch (a) {
            case 0:
                return this.x;
            case 1:
                return this.y;
            case 2:
                return this.z;
            case 3:
                return this.w;
            default:
                throw new Error("index is out of range: " + a)
        }
    },
    copy: function(a) {
        this.x = a.x;
        this.y = a.y;
        this.z = a.z;
        this.w = (a.w !== undefined) ? a.w : 1;
        return this
    },
    add: function(b, a) {
        if (a !== undefined) {
            console.warn("THREE.Vector4: .add() now only accepts one argument. Use .addVectors( a, b ) instead.");
            return this.addVectors(b, a)
        }
        this.x += b.x;
        this.y += b.y;
        this.z += b.z;
        this.w += b.w;
        return this
    },
    addScalar: function(a) {
        this.x += a;
        this.y += a;
        this.z += a;
        this.w += a;
        return this
    },
    addVectors: function(d, c) {
        this.x = d.x + c.x;
        this.y = d.y + c.y;
        this.z = d.z + c.z;
        this.w = d.w + c.w;
        return this
    },
    sub: function(b, a) {
        if (a !== undefined) {
            console.warn("THREE.Vector4: .sub() now only accepts one argument. Use .subVectors( a, b ) instead.");
            return this.subVectors(b, a)
        }
        this.x -= b.x;
        this.y -= b.y;
        this.z -= b.z;
        this.w -= b.w;
        return this
    },
    subVectors: function(d, c) {
        this.x = d.x - c.x;
        this.y = d.y - c.y;
        this.z = d.z - c.z;
        this.w = d.w - c.w;
        return this
    },
    multiplyScalar: function(a) {
        this.x *= a;
        this.y *= a;
        this.z *= a;
        this.w *= a;
        return this
    },
    applyMatrix4: function(b) {
        var a = this.x;
        var g = this.y;
        var f = this.z;
        var c = this.w;
        var d = b.elements;
        this.x = d[0] * a + d[4] * g + d[8] * f + d[12] * c;
        this.y = d[1] * a + d[5] * g + d[9] * f + d[13] * c;
        this.z = d[2] * a + d[6] * g + d[10] * f + d[14] * c;
        this.w = d[3] * a + d[7] * g + d[11] * f + d[15] * c;
        return this
    },
    divideScalar: function(b) {
        if (b !== 0) {
            var a = 1 / b;
            this.x *= a;
            this.y *= a;
            this.z *= a;
            this.w *= a
        } else {
            this.x = 0;
            this.y = 0;
            this.z = 0;
            this.w = 1
        }
        return this
    },
    setAxisAngleFromQuaternion: function(b) {
        this.w = 2 * Math.acos(b.w);
        var a = Math.sqrt(1 - b.w * b.w);
        if (a < 0.0001) {
            this.x = 1;
            this.y = 0;
            this.z = 0
        } else {
            this.x = b.x / a;
            this.y = b.y / a;
            this.z = b.z / a
        }
        return this
    },
    setAxisAngleFromRotationMatrix: function(t) {
        var u, j, i, h, D = 0.01,
            k = 0.1,
            g = t.elements,
            C = g[0],
            A = g[4],
            v = g[8],
            e = g[1],
            c = g[5],
            a = g[9],
            r = g[2],
            p = g[6],
            n = g[10];
        if ((Math.abs(A - e) < D) && (Math.abs(v - r) < D) && (Math.abs(a - p) < D)) {
            if ((Math.abs(A + e) < k) && (Math.abs(v + r) < k) && (Math.abs(a + p) < k) && (Math.abs(C + c + n - 3) < k)) {
                this.set(1, 0, 0, 0);
                return this
            }
            u = Math.PI;
            var f = (C + 1) / 2;
            var q = (c + 1) / 2;
            var B = (n + 1) / 2;
            var d = (A + e) / 4;
            var b = (v + r) / 4;
            var o = (a + p) / 4;
            if ((f > q) && (f > B)) {
                if (f < D) {
                    j = 0;
                    i = 0.707106781;
                    h = 0.707106781
                } else {
                    j = Math.sqrt(f);
                    i = d / j;
                    h = b / j
                }
            } else {
                if (q > B) {
                    if (q < D) {
                        j = 0.707106781;
                        i = 0;
                        h = 0.707106781
                    } else {
                        i = Math.sqrt(q);
                        j = d / i;
                        h = o / i
                    }
                } else {
                    if (B < D) {
                        j = 0.707106781;
                        i = 0.707106781;
                        h = 0
                    } else {
                        h = Math.sqrt(B);
                        j = b / h;
                        i = o / h
                    }
                }
            }
            this.set(j, i, h, u);
            return this
        }
        var l = Math.sqrt((p - a) * (p - a) + (v - r) * (v - r) + (e - A) * (e - A));
        if (Math.abs(l) < 0.001) {
            l = 1
        }
        this.x = (p - a) / l;
        this.y = (v - r) / l;
        this.z = (e - A) / l;
        this.w = Math.acos((C + c + n - 1) / 2);
        return this
    },
    min: function(a) {
        if (this.x > a.x) {
            this.x = a.x
        }
        if (this.y > a.y) {
            this.y = a.y
        }
        if (this.z > a.z) {
            this.z = a.z
        }
        if (this.w > a.w) {
            this.w = a.w
        }
        return this
    },
    max: function(a) {
        if (this.x < a.x) {
            this.x = a.x
        }
        if (this.y < a.y) {
            this.y = a.y
        }
        if (this.z < a.z) {
            this.z = a.z
        }
        if (this.w < a.w) {
            this.w = a.w
        }
        return this
    },
    clamp: function(b, a) {
        if (this.x < b.x) {
            this.x = b.x
        } else {
            if (this.x > a.x) {
                this.x = a.x
            }
        }
        if (this.y < b.y) {
            this.y = b.y
        } else {
            if (this.y > a.y) {
                this.y = a.y
            }
        }
        if (this.z < b.z) {
            this.z = b.z
        } else {
            if (this.z > a.z) {
                this.z = a.z
            }
        }
        if (this.w < b.w) {
            this.w = b.w
        } else {
            if (this.w > a.w) {
                this.w = a.w
            }
        }
        return this
    },
    clampScalar: (function() {
        var b, a;
        return function(c, d) {
            if (b === undefined) {
                b = new THREE.Vector4();
                a = new THREE.Vector4()
            }
            b.set(c, c, c, c);
            a.set(d, d, d, d);
            return this.clamp(b, a)
        }
    })(),
    floor: function() {
        this.x = Math.floor(this.x);
        this.y = Math.floor(this.y);
        this.z = Math.floor(this.z);
        this.w = Math.floor(this.w);
        return this
    },
    ceil: function() {
        this.x = Math.ceil(this.x);
        this.y = Math.ceil(this.y);
        this.z = Math.ceil(this.z);
        this.w = Math.ceil(this.w);
        return this
    },
    round: function() {
        this.x = Math.round(this.x);
        this.y = Math.round(this.y);
        this.z = Math.round(this.z);
        this.w = Math.round(this.w);
        return this
    },
    roundToZero: function() {
        this.x = (this.x < 0) ? Math.ceil(this.x) : Math.floor(this.x);
        this.y = (this.y < 0) ? Math.ceil(this.y) : Math.floor(this.y);
        this.z = (this.z < 0) ? Math.ceil(this.z) : Math.floor(this.z);
        this.w = (this.w < 0) ? Math.ceil(this.w) : Math.floor(this.w);
        return this
    },
    negate: function() {
        this.x = -this.x;
        this.y = -this.y;
        this.z = -this.z;
        this.w = -this.w;
        return this
    },
    dot: function(a) {
        return this.x * a.x + this.y * a.y + this.z * a.z + this.w * a.w
    },
    lengthSq: function() {
        return this.x * this.x + this.y * this.y + this.z * this.z + this.w * this.w
    },
    length: function() {
        return Math.sqrt(this.x * this.x + this.y * this.y + this.z * this.z + this.w * this.w)
    },
    lengthManhattan: function() {
        return Math.abs(this.x) + Math.abs(this.y) + Math.abs(this.z) + Math.abs(this.w)
    },
    normalize: function() {
        return this.divideScalar(this.length())
    },
    setLength: function(a) {
        var b = this.length();
        if (b !== 0 && a !== b) {
            this.multiplyScalar(a / b)
        }
        return this
    },
    lerp: function(a, b) {
        this.x += (a.x - this.x) * b;
        this.y += (a.y - this.y) * b;
        this.z += (a.z - this.z) * b;
        this.w += (a.w - this.w) * b;
        return this
    },
    equals: function(a) {
        return ((a.x === this.x) && (a.y === this.y) && (a.z === this.z) && (a.w === this.w))
    },
    fromArray: function(b, a) {
        if (a === undefined) {
            a = 0
        }
        this.x = b[a];
        this.y = b[a + 1];
        this.z = b[a + 2];
        this.w = b[a + 3];
        return this
    },
    toArray: function(b, a) {
        if (b === undefined) {
            b = []
        }
        if (a === undefined) {
            a = 0
        }
        b[a] = this.x;
        b[a + 1] = this.y;
        b[a + 2] = this.z;
        b[a + 3] = this.w;
        return b
    },
    fromAttribute: function(b, a, c) {
        if (c === undefined) {
            c = 0
        }
        a = a * b.itemSize + c;
        this.x = b.array[a];
        this.y = b.array[a + 1];
        this.z = b.array[a + 2];
        this.w = b.array[a + 3];
        return this
    },
    clone: function() {
        return new THREE.Vector4(this.x, this.y, this.z, this.w)
    }
};
THREE.Euler = function(b, d, c, a) {
    this._x = b || 0;
    this._y = d || 0;
    this._z = c || 0;
    this._order = a || THREE.Euler.DefaultOrder
};
THREE.Euler.RotationOrders = ["XYZ", "YZX", "ZXY", "XZY", "YXZ", "ZYX"];
THREE.Euler.DefaultOrder = "XYZ";
THREE.Euler.prototype = {
    constructor: THREE.Euler,
    _x: 0,
    _y: 0,
    _z: 0,
    _order: THREE.Euler.DefaultOrder,
    get x() {
        return this._x
    },
    set x(a) {
        this._x = a;
        this.onChangeCallback()
    },
    get y() {
        return this._y
    },
    set y(a) {
        this._y = a;
        this.onChangeCallback()
    },
    get z() {
        return this._z
    },
    set z(a) {
        this._z = a;
        this.onChangeCallback()
    },
    get order() {
        return this._order
    },
    set order(a) {
        this._order = a;
        this.onChangeCallback()
    },
    set: function(b, d, c, a) {
        this._x = b;
        this._y = d;
        this._z = c;
        this._order = a || this._order;
        this.onChangeCallback();
        return this
    },
    copy: function(a) {
        this._x = a._x;
        this._y = a._y;
        this._z = a._z;
        this._order = a._order;
        this.onChangeCallback();
        return this
    },
    setFromRotationMatrix: function(e, f, g) {
        var j = THREE.Math.clamp;
        var d = e.elements;
        var k = d[0],
            i = d[4],
            h = d[8];
        var c = d[1],
            b = d[5],
            a = d[9];
        var o = d[2],
            n = d[6],
            l = d[10];
        f = f || this._order;
        if (f === "XYZ") {
            this._y = Math.asin(j(h, -1, 1));
            if (Math.abs(h) < 0.99999) {
                this._x = Math.atan2(-a, l);
                this._z = Math.atan2(-i, k)
            } else {
                this._x = Math.atan2(n, b);
                this._z = 0
            }
        } else {
            if (f === "YXZ") {
                this._x = Math.asin(-j(a, -1, 1));
                if (Math.abs(a) < 0.99999) {
                    this._y = Math.atan2(h, l);
                    this._z = Math.atan2(c, b)
                } else {
                    this._y = Math.atan2(-o, k);
                    this._z = 0
                }
            } else {
                if (f === "ZXY") {
                    this._x = Math.asin(j(n, -1, 1));
                    if (Math.abs(n) < 0.99999) {
                        this._y = Math.atan2(-o, l);
                        this._z = Math.atan2(-i, b)
                    } else {
                        this._y = 0;
                        this._z = Math.atan2(c, k)
                    }
                } else {
                    if (f === "ZYX") {
                        this._y = Math.asin(-j(o, -1, 1));
                        if (Math.abs(o) < 0.99999) {
                            this._x = Math.atan2(n, l);
                            this._z = Math.atan2(c, k)
                        } else {
                            this._x = 0;
                            this._z = Math.atan2(-i, b)
                        }
                    } else {
                        if (f === "YZX") {
                            this._z = Math.asin(j(c, -1, 1));
                            if (Math.abs(c) < 0.99999) {
                                this._x = Math.atan2(-a, b);
                                this._y = Math.atan2(-o, k)
                            } else {
                                this._x = 0;
                                this._y = Math.atan2(h, l)
                            }
                        } else {
                            if (f === "XZY") {
                                this._z = Math.asin(-j(i, -1, 1));
                                if (Math.abs(i) < 0.99999) {
                                    this._x = Math.atan2(n, b);
                                    this._y = Math.atan2(h, k)
                                } else {
                                    this._x = Math.atan2(-a, l);
                                    this._y = 0
                                }
                            } else {
                                console.warn("THREE.Euler: .setFromRotationMatrix() given unsupported order: " + f)
                            }
                        }
                    }
                }
            }
        }
        this._order = f;
        if (g !== false) {
            this.onChangeCallback()
        }
        return this
    },
    setFromQuaternion: function() {
        var a;
        return function(c, b, d) {
            if (a === undefined) {
                a = new THREE.Matrix4()
            }
            a.makeRotationFromQuaternion(c);
            this.setFromRotationMatrix(a, b, d);
            return this
        }
    }(),
    setFromVector3: function(b, a) {
        return this.set(b.x, b.y, b.z, a || this._order)
    },
    reorder: function() {
        var a = new THREE.Quaternion();
        return function(b) {
            a.setFromEuler(this);
            this.setFromQuaternion(a, b)
        }
    }(),
    equals: function(a) {
        return (a._x === this._x) && (a._y === this._y) && (a._z === this._z) && (a._order === this._order)
    },
    fromArray: function(a) {
        this._x = a[0];
        this._y = a[1];
        this._z = a[2];
        if (a[3] !== undefined) {
            this._order = a[3]
        }
        this.onChangeCallback();
        return this
    },
    toArray: function() {
        return [this._x, this._y, this._z, this._order]
    },
    toVector3: function(a) {
        if (a) {
            return a.set(this._x, this._y, this._z)
        } else {
            return new THREE.Vector3(this._x, this._y, this._z)
        }
    },
    onChange: function(a) {
        this.onChangeCallback = a;
        return this
    },
    onChangeCallback: function() {},
    clone: function() {
        return new THREE.Euler(this._x, this._y, this._z, this._order)
    }
};
THREE.Line3 = function(b, a) {
    this.start = (b !== undefined) ? b : new THREE.Vector3();
    this.end = (a !== undefined) ? a : new THREE.Vector3()
};
THREE.Line3.prototype = {
    constructor: THREE.Line3,
    set: function(b, a) {
        this.start.copy(b);
        this.end.copy(a);
        return this
    },
    copy: function(a) {
        this.start.copy(a.start);
        this.end.copy(a.end);
        return this
    },
    center: function(b) {
        var a = b || new THREE.Vector3();
        return a.addVectors(this.start, this.end).multiplyScalar(0.5)
    },
    delta: function(b) {
        var a = b || new THREE.Vector3();
        return a.subVectors(this.end, this.start)
    },
    distanceSq: function() {
        return this.start.distanceToSquared(this.end)
    },
    distance: function() {
        return this.start.distanceTo(this.end)
    },
    at: function(c, b) {
        var a = b || new THREE.Vector3();
        return this.delta(a).multiplyScalar(c).add(this.start)
    },
    closestPointToPointParameter: function() {
        var b = new THREE.Vector3();
        var a = new THREE.Vector3();
        return function(c, g) {
            b.subVectors(c, this.start);
            a.subVectors(this.end, this.start);
            var f = a.dot(a);
            var e = a.dot(b);
            var d = e / f;
            if (g) {
                d = THREE.Math.clamp(d, 0, 1)
            }
            return d
        }
    }(),
    closestPointToPoint: function(b, e, d) {
        var c = this.closestPointToPointParameter(b, e);
        var a = d || new THREE.Vector3();
        return this.delta(a).multiplyScalar(c).add(this.start)
    },
    applyMatrix4: function(a) {
        this.start.applyMatrix4(a);
        this.end.applyMatrix4(a);
        return this
    },
    equals: function(a) {
        return a.start.equals(this.start) && a.end.equals(this.end)
    },
    clone: function() {
        return new THREE.Line3().copy(this)
    }
};
THREE.Box2 = function(b, a) {
    this.min = (b !== undefined) ? b : new THREE.Vector2(Infinity, Infinity);
    this.max = (a !== undefined) ? a : new THREE.Vector2(-Infinity, -Infinity)
};
THREE.Box2.prototype = {
    constructor: THREE.Box2,
    set: function(b, a) {
        this.min.copy(b);
        this.max.copy(a);
        return this
    },
    setFromPoints: function(c) {
        this.makeEmpty();
        for (var b = 0, a = c.length; b < a; b++) {
            this.expandByPoint(c[b])
        }
        return this
    },
    setFromCenterAndSize: function() {
        var a = new THREE.Vector2();
        return function(b, d) {
            var c = a.copy(d).multiplyScalar(0.5);
            this.min.copy(b).sub(c);
            this.max.copy(b).add(c);
            return this
        }
    }(),
    copy: function(a) {
        this.min.copy(a.min);
        this.max.copy(a.max);
        return this
    },
    makeEmpty: function() {
        this.min.x = this.min.y = Infinity;
        this.max.x = this.max.y = -Infinity;
        return this
    },
    empty: function() {
        return (this.max.x < this.min.x) || (this.max.y < this.min.y)
    },
    center: function(b) {
        var a = b || new THREE.Vector2();
        return a.addVectors(this.min, this.max).multiplyScalar(0.5)
    },
    size: function(b) {
        var a = b || new THREE.Vector2();
        return a.subVectors(this.max, this.min)
    },
    expandByPoint: function(a) {
        this.min.min(a);
        this.max.max(a);
        return this
    },
    expandByVector: function(a) {
        this.min.sub(a);
        this.max.add(a);
        return this
    },
    expandByScalar: function(a) {
        this.min.addScalar(-a);
        this.max.addScalar(a);
        return this
    },
    containsPoint: function(a) {
        if (a.x < this.min.x || a.x > this.max.x || a.y < this.min.y || a.y > this.max.y) {
            return false
        }
        return true
    },
    containsBox: function(a) {
        if ((this.min.x <= a.min.x) && (a.max.x <= this.max.x) && (this.min.y <= a.min.y) && (a.max.y <= this.max.y)) {
            return true
        }
        return false
    },
    getParameter: function(b, c) {
        var a = c || new THREE.Vector2();
        return a.set((b.x - this.min.x) / (this.max.x - this.min.x), (b.y - this.min.y) / (this.max.y - this.min.y))
    },
    isIntersectionBox: function(a) {
        if (a.max.x < this.min.x || a.min.x > this.max.x || a.max.y < this.min.y || a.min.y > this.max.y) {
            return false
        }
        return true
    },
    clampPoint: function(b, c) {
        var a = c || new THREE.Vector2();
        return a.copy(b).clamp(this.min, this.max)
    },
    distanceToPoint: function() {
        var a = new THREE.Vector2();
        return function(b) {
            var c = a.copy(b).clamp(this.min, this.max);
            return c.sub(b).length()
        }
    }(),
    intersect: function(a) {
        this.min.max(a.min);
        this.max.min(a.max);
        return this
    },
    union: function(a) {
        this.min.min(a.min);
        this.max.max(a.max);
        return this
    },
    translate: function(a) {
        this.min.add(a);
        this.max.add(a);
        return this
    },
    equals: function(a) {
        return a.min.equals(this.min) && a.max.equals(this.max)
    },
    clone: function() {
        return new THREE.Box2().copy(this)
    }
};
THREE.Box3 = function(b, a) {
    this.min = (b !== undefined) ? b : new THREE.Vector3(Infinity, Infinity, Infinity);
    this.max = (a !== undefined) ? a : new THREE.Vector3(-Infinity, -Infinity, -Infinity)
};
THREE.Box3.prototype = {
    constructor: THREE.Box3,
    set: function(b, a) {
        this.min.copy(b);
        this.max.copy(a);
        return this
    },
    setFromPoints: function(c) {
        this.makeEmpty();
        for (var b = 0, a = c.length; b < a; b++) {
            this.expandByPoint(c[b])
        }
        return this
    },
    setFromCenterAndSize: function() {
        var a = new THREE.Vector3();
        return function(b, d) {
            var c = a.copy(d).multiplyScalar(0.5);
            this.min.copy(b).sub(c);
            this.max.copy(b).add(c);
            return this
        }
    }(),
    setFromObject: function() {
        var a = new THREE.Vector3();
        return function(b) {
            var c = this;
            b.updateMatrixWorld(true);
            this.makeEmpty();
            b.traverse(function(h) {
                var j = h.geometry;
                if (j !== undefined) {
                    if (j instanceof THREE.Geometry) {
                        var f = j.vertices;
                        for (var g = 0, e = f.length; g < e; g++) {
                            a.copy(f[g]);
                            a.applyMatrix4(h.matrixWorld);
                            c.expandByPoint(a)
                        }
                    } else {
                        if (j instanceof THREE.BufferGeometry && j.attributes.position !== undefined) {
                            var d = j.attributes.position.array;
                            for (var g = 0, e = d.length; g < e; g += 3) {
                                a.set(d[g], d[g + 1], d[g + 2]);
                                a.applyMatrix4(h.matrixWorld);
                                c.expandByPoint(a)
                            }
                        }
                    }
                }
            });
            return this
        }
    }(),
    copy: function(a) {
        this.min.copy(a.min);
        this.max.copy(a.max);
        return this
    },
    makeEmpty: function() {
        this.min.x = this.min.y = this.min.z = Infinity;
        this.max.x = this.max.y = this.max.z = -Infinity;
        return this
    },
    empty: function() {
        return (this.max.x < this.min.x) || (this.max.y < this.min.y) || (this.max.z < this.min.z)
    },
    center: function(b) {
        var a = b || new THREE.Vector3();
        return a.addVectors(this.min, this.max).multiplyScalar(0.5)
    },
    size: function(b) {
        var a = b || new THREE.Vector3();
        return a.subVectors(this.max, this.min)
    },
    expandByPoint: function(a) {
        this.min.min(a);
        this.max.max(a);
        return this
    },
    expandByVector: function(a) {
        this.min.sub(a);
        this.max.add(a);
        return this
    },
    expandByScalar: function(a) {
        this.min.addScalar(-a);
        this.max.addScalar(a);
        return this
    },
    containsPoint: function(a) {
        if (a.x < this.min.x || a.x > this.max.x || a.y < this.min.y || a.y > this.max.y || a.z < this.min.z || a.z > this.max.z) {
            return false
        }
        return true
    },
    containsBox: function(a) {
        if ((this.min.x <= a.min.x) && (a.max.x <= this.max.x) && (this.min.y <= a.min.y) && (a.max.y <= this.max.y) && (this.min.z <= a.min.z) && (a.max.z <= this.max.z)) {
            return true
        }
        return false
    },
    getParameter: function(b, c) {
        var a = c || new THREE.Vector3();
        return a.set((b.x - this.min.x) / (this.max.x - this.min.x), (b.y - this.min.y) / (this.max.y - this.min.y), (b.z - this.min.z) / (this.max.z - this.min.z))
    },
    isIntersectionBox: function(a) {
        if (a.max.x < this.min.x || a.min.x > this.max.x || a.max.y < this.min.y || a.min.y > this.max.y || a.max.z < this.min.z || a.min.z > this.max.z) {
            return false
        }
        return true
    },
    clampPoint: function(b, c) {
        var a = c || new THREE.Vector3();
        return a.copy(b).clamp(this.min, this.max)
    },
    distanceToPoint: function() {
        var a = new THREE.Vector3();
        return function(b) {
            var c = a.copy(b).clamp(this.min, this.max);
            return c.sub(b).length()
        }
    }(),
    getBoundingSphere: function() {
        var a = new THREE.Vector3();
        return function(c) {
            var b = c || new THREE.Sphere();
            b.center = this.center();
            b.radius = this.size(a).length() * 0.5;
            return b
        }
    }(),
    intersect: function(a) {
        this.min.max(a.min);
        this.max.min(a.max);
        return this
    },
    union: function(a) {
        this.min.min(a.min);
        this.max.max(a.max);
        return this
    },
    applyMatrix4: function() {
        var a = [new THREE.Vector3(), new THREE.Vector3(), new THREE.Vector3(), new THREE.Vector3(), new THREE.Vector3(), new THREE.Vector3(), new THREE.Vector3(), new THREE.Vector3()];
        return function(b) {
            a[0].set(this.min.x, this.min.y, this.min.z).applyMatrix4(b);
            a[1].set(this.min.x, this.min.y, this.max.z).applyMatrix4(b);
            a[2].set(this.min.x, this.max.y, this.min.z).applyMatrix4(b);
            a[3].set(this.min.x, this.max.y, this.max.z).applyMatrix4(b);
            a[4].set(this.max.x, this.min.y, this.min.z).applyMatrix4(b);
            a[5].set(this.max.x, this.min.y, this.max.z).applyMatrix4(b);
            a[6].set(this.max.x, this.max.y, this.min.z).applyMatrix4(b);
            a[7].set(this.max.x, this.max.y, this.max.z).applyMatrix4(b);
            this.makeEmpty();
            this.setFromPoints(a);
            return this
        }
    }(),
    translate: function(a) {
        this.min.add(a);
        this.max.add(a);
        return this
    },
    equals: function(a) {
        return a.min.equals(this.min) && a.max.equals(this.max)
    },
    clone: function() {
        return new THREE.Box3().copy(this)
    }
};
THREE.Matrix3 = function() {
    this.elements = new Float32Array([1, 0, 0, 0, 1, 0, 0, 0, 1]);
    if (arguments.length > 0) {
        console.error("THREE.Matrix3: the constructor no longer reads arguments. use .set() instead.")
    }
};
THREE.Matrix3.prototype = {
    constructor: THREE.Matrix3,
    set: function(h, g, f, e, d, c, a, j, i) {
        var b = this.elements;
        b[0] = h;
        b[3] = g;
        b[6] = f;
        b[1] = e;
        b[4] = d;
        b[7] = c;
        b[2] = a;
        b[5] = j;
        b[8] = i;
        return this
    },
    identity: function() {
        this.set(1, 0, 0, 0, 1, 0, 0, 0, 1);
        return this
    },
    copy: function(a) {
        var b = a.elements;
        this.set(b[0], b[3], b[6], b[1], b[4], b[7], b[2], b[5], b[8]);
        return this
    },
    multiplyVector3: function(a) {
        console.warn("THREE.Matrix3: .multiplyVector3() has been removed. Use vector.applyMatrix3( matrix ) instead.");
        return a.applyMatrix3(this)
    },
    multiplyVector3Array: function(b) {
        console.warn("THREE.Matrix3: .multiplyVector3Array() has been renamed. Use matrix.applyToVector3Array( array ) instead.");
        return this.applyToVector3Array(b)
    },
    applyToVector3Array: function() {
        var a = new THREE.Vector3();
        return function(g, f, e) {
            if (f === undefined) {
                f = 0
            }
            if (e === undefined) {
                e = g.length
            }
            for (var d = 0, c = f, b; d < e; d += 3, c += 3) {
                a.x = g[c];
                a.y = g[c + 1];
                a.z = g[c + 2];
                a.applyMatrix3(this);
                g[c] = a.x;
                g[c + 1] = a.y;
                g[c + 2] = a.z
            }
            return g
        }
    }(),
    multiplyScalar: function(a) {
        var b = this.elements;
        b[0] *= a;
        b[3] *= a;
        b[6] *= a;
        b[1] *= a;
        b[4] *= a;
        b[7] *= a;
        b[2] *= a;
        b[5] *= a;
        b[8] *= a;
        return this
    },
    determinant: function() {
        var j = this.elements;
        var s = j[0],
            r = j[1],
            q = j[2],
            p = j[3],
            o = j[4],
            n = j[5],
            m = j[6],
            l = j[7],
            k = j[8];
        return s * o * k - s * n * l - r * p * k + r * n * m + q * p * l - q * o * m
    },
    getInverse: function(b, a) {
        var d = b.elements;
        var f = this.elements;
        f[0] = d[10] * d[5] - d[6] * d[9];
        f[1] = -d[10] * d[1] + d[2] * d[9];
        f[2] = d[6] * d[1] - d[2] * d[5];
        f[3] = -d[10] * d[4] + d[6] * d[8];
        f[4] = d[10] * d[0] - d[2] * d[8];
        f[5] = -d[6] * d[0] + d[2] * d[4];
        f[6] = d[9] * d[4] - d[5] * d[8];
        f[7] = -d[9] * d[0] + d[1] * d[8];
        f[8] = d[5] * d[0] - d[1] * d[4];
        var c = d[0] * f[0] + d[1] * f[3] + d[2] * f[6];
        if (c === 0) {
            var e = "Matrix3.getInverse(): can't invert matrix, determinant is 0";
            if (a || false) {
                throw new Error(e)
            } else {
                console.warn(e)
            }
            this.identity();
            return this
        }
        this.multiplyScalar(1 / c);
        return this
    },
    transpose: function() {
        var b, a = this.elements;
        b = a[1];
        a[1] = a[3];
        a[3] = b;
        b = a[2];
        a[2] = a[6];
        a[6] = b;
        b = a[5];
        a[5] = a[7];
        a[7] = b;
        return this
    },
    flattenToArrayOffset: function(c, b) {
        var a = this.elements;
        c[b] = a[0];
        c[b + 1] = a[1];
        c[b + 2] = a[2];
        c[b + 3] = a[3];
        c[b + 4] = a[4];
        c[b + 5] = a[5];
        c[b + 6] = a[6];
        c[b + 7] = a[7];
        c[b + 8] = a[8];
        return c
    },
    getNormalMatrix: function(a) {
        this.getInverse(a).transpose();
        return this
    },
    transposeIntoArray: function(b) {
        var a = this.elements;
        b[0] = a[0];
        b[1] = a[3];
        b[2] = a[6];
        b[3] = a[1];
        b[4] = a[4];
        b[5] = a[7];
        b[6] = a[2];
        b[7] = a[5];
        b[8] = a[8];
        return this
    },
    fromArray: function(a) {
        this.elements.set(a);
        return this
    },
    toArray: function() {
        var a = this.elements;
        return [a[0], a[1], a[2], a[3], a[4], a[5], a[6], a[7], a[8]]
    },
    clone: function() {
        return new THREE.Matrix3().fromArray(this.elements)
    }
};
THREE.Matrix4 = function() {
    this.elements = new Float32Array([1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1]);
    if (arguments.length > 0) {
        console.error("THREE.Matrix4: the constructor no longer reads arguments. use .set() instead.")
    }
};
THREE.Matrix4.prototype = {
    constructor: THREE.Matrix4,
    set: function(n, m, k, i, f, e, d, c, a, q, p, o, l, j, h, g) {
        var b = this.elements;
        b[0] = n;
        b[4] = m;
        b[8] = k;
        b[12] = i;
        b[1] = f;
        b[5] = e;
        b[9] = d;
        b[13] = c;
        b[2] = a;
        b[6] = q;
        b[10] = p;
        b[14] = o;
        b[3] = l;
        b[7] = j;
        b[11] = h;
        b[15] = g;
        return this
    },
    identity: function() {
        this.set(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
        return this
    },
    copy: function(a) {
        this.elements.set(a.elements);
        return this
    },
    extractPosition: function(a) {
        console.warn("THREE.Matrix4: .extractPosition() has been renamed to .copyPosition().");
        return this.copyPosition(a)
    },
    copyPosition: function(a) {
        var c = this.elements;
        var b = a.elements;
        c[12] = b[12];
        c[13] = b[13];
        c[14] = b[14];
        return this
    },
    extractBasis: function(b, a, c) {
        var d = this.elements;
        b.set(d[0], d[1], d[2]);
        a.set(d[4], d[5], d[6]);
        c.set(d[8], d[9], d[10]);
        return this
    },
    makeBasis: function(b, a, c) {
        this.set(b.x, a.x, c.x, 0, b.y, a.y, c.y, 0, b.z, a.z, c.z, 0, 0, 0, 0, 1);
        return this
    },
    extractRotation: function() {
        var a = new THREE.Vector3();
        return function(b) {
            var g = this.elements;
            var f = b.elements;
            var e = 1 / a.set(f[0], f[1], f[2]).length();
            var d = 1 / a.set(f[4], f[5], f[6]).length();
            var c = 1 / a.set(f[8], f[9], f[10]).length();
            g[0] = f[0] * e;
            g[1] = f[1] * e;
            g[2] = f[2] * e;
            g[4] = f[4] * d;
            g[5] = f[5] * d;
            g[6] = f[6] * d;
            g[8] = f[8] * c;
            g[9] = f[9] * c;
            g[10] = f[10] * c;
            return this
        }
    }(),
    makeRotationFromEuler: function(o) {
        if (o instanceof THREE.Euler === false) {
            console.error("THREE.Matrix: .makeRotationFromEuler() now expects a Euler rotation rather than a Vector3 and order.")
        }
        var k = this.elements;
        var n = o.x,
            m = o.y,
            l = o.z;
        var G = Math.cos(n),
            F = Math.sin(n);
        var D = Math.cos(m),
            A = Math.sin(m);
        var t = Math.cos(l),
            r = Math.sin(l);
        if (o.order === "XYZ") {
            var v = G * t,
                s = G * r,
                h = F * t,
                g = F * r;
            k[0] = D * t;
            k[4] = -D * r;
            k[8] = A;
            k[1] = s + h * A;
            k[5] = v - g * A;
            k[9] = -F * D;
            k[2] = g - v * A;
            k[6] = h + s * A;
            k[10] = G * D
        } else {
            if (o.order === "YXZ") {
                var q = D * t,
                    p = D * r,
                    C = A * t,
                    u = A * r;
                k[0] = q + u * F;
                k[4] = C * F - p;
                k[8] = G * A;
                k[1] = G * r;
                k[5] = G * t;
                k[9] = -F;
                k[2] = p * F - C;
                k[6] = u + q * F;
                k[10] = G * D
            } else {
                if (o.order === "ZXY") {
                    var q = D * t,
                        p = D * r,
                        C = A * t,
                        u = A * r;
                    k[0] = q - u * F;
                    k[4] = -G * r;
                    k[8] = C + p * F;
                    k[1] = p + C * F;
                    k[5] = G * t;
                    k[9] = u - q * F;
                    k[2] = -G * A;
                    k[6] = F;
                    k[10] = G * D
                } else {
                    if (o.order === "ZYX") {
                        var v = G * t,
                            s = G * r,
                            h = F * t,
                            g = F * r;
                        k[0] = D * t;
                        k[4] = h * A - s;
                        k[8] = v * A + g;
                        k[1] = D * r;
                        k[5] = g * A + v;
                        k[9] = s * A - h;
                        k[2] = -A;
                        k[6] = F * D;
                        k[10] = G * D
                    } else {
                        if (o.order === "YZX") {
                            var E = G * D,
                                B = G * A,
                                j = F * D,
                                i = F * A;
                            k[0] = D * t;
                            k[4] = i - E * r;
                            k[8] = j * r + B;
                            k[1] = r;
                            k[5] = G * t;
                            k[9] = -F * t;
                            k[2] = -A * t;
                            k[6] = B * r + j;
                            k[10] = E - i * r
                        } else {
                            if (o.order === "XZY") {
                                var E = G * D,
                                    B = G * A,
                                    j = F * D,
                                    i = F * A;
                                k[0] = D * t;
                                k[4] = -r;
                                k[8] = A * t;
                                k[1] = E * r + i;
                                k[5] = G * t;
                                k[9] = B * r - j;
                                k[2] = j * r - B;
                                k[6] = F * t;
                                k[10] = i * r + E
                            }
                        }
                    }
                }
            }
        }
        k[3] = 0;
        k[7] = 0;
        k[11] = 0;
        k[12] = 0;
        k[13] = 0;
        k[14] = 0;
        k[15] = 1;
        return this
    },
    setRotationFromQuaternion: function(a) {
        console.warn("THREE.Matrix4: .setRotationFromQuaternion() has been renamed to .makeRotationFromQuaternion().");
        return this.makeRotationFromQuaternion(a)
    },
    makeRotationFromQuaternion: function(l) {
        var e = this.elements;
        var h = l.x,
            g = l.y,
            f = l.z,
            i = l.w;
        var n = h + h,
            a = g + g,
            j = f + f;
        var d = h * n,
            c = h * a,
            b = h * j;
        var m = g * a,
            k = g * j,
            r = f * j;
        var s = i * n,
            p = i * a,
            o = i * j;
        e[0] = 1 - (m + r);
        e[4] = c - o;
        e[8] = b + p;
        e[1] = c + o;
        e[5] = 1 - (d + r);
        e[9] = k - s;
        e[2] = b - p;
        e[6] = k + s;
        e[10] = 1 - (d + m);
        e[3] = 0;
        e[7] = 0;
        e[11] = 0;
        e[12] = 0;
        e[13] = 0;
        e[14] = 0;
        e[15] = 1;
        return this
    },
    lookAt: function() {
        var a = new THREE.Vector3();
        var c = new THREE.Vector3();
        var b = new THREE.Vector3();
        return function(e, f, d) {
            var g = this.elements;
            b.subVectors(e, f).normalize();
            if (b.length() === 0) {
                b.z = 1
            }
            a.crossVectors(d, b).normalize();
            if (a.length() === 0) {
                b.x += 0.0001;
                a.crossVectors(d, b).normalize()
            }
            c.crossVectors(b, a);
            g[0] = a.x;
            g[4] = c.x;
            g[8] = b.x;
            g[1] = a.y;
            g[5] = c.y;
            g[9] = b.y;
            g[2] = a.z;
            g[6] = c.z;
            g[10] = b.z;
            return this
        }
    }(),
    multiply: function(a, b) {
        if (b !== undefined) {
            console.warn("THREE.Matrix4: .multiply() now only accepts one argument. Use .multiplyMatrices( a, b ) instead.");
            return this.multiplyMatrices(a, b)
        }
        return this.multiplyMatrices(this, a)
    },
    multiplyMatrices: function(Q, P) {
        var s = Q.elements;
        var O = P.elements;
        var c = this.elements;
        var p = s[0],
            n = s[4],
            m = s[8],
            l = s[12];
        var N = s[1],
            M = s[5],
            L = s[9],
            K = s[13];
        var F = s[2],
            E = s[6],
            D = s[10],
            C = s[14];
        var t = s[3],
            r = s[7],
            q = s[11],
            o = s[15];
        var i = O[0],
            g = O[4],
            e = O[8],
            d = O[12];
        var J = O[1],
            I = O[5],
            H = O[9],
            G = O[13];
        var B = O[2],
            A = O[6],
            v = O[10],
            u = O[14];
        var k = O[3],
            j = O[7],
            h = O[11],
            f = O[15];
        c[0] = p * i + n * J + m * B + l * k;
        c[4] = p * g + n * I + m * A + l * j;
        c[8] = p * e + n * H + m * v + l * h;
        c[12] = p * d + n * G + m * u + l * f;
        c[1] = N * i + M * J + L * B + K * k;
        c[5] = N * g + M * I + L * A + K * j;
        c[9] = N * e + M * H + L * v + K * h;
        c[13] = N * d + M * G + L * u + K * f;
        c[2] = F * i + E * J + D * B + C * k;
        c[6] = F * g + E * I + D * A + C * j;
        c[10] = F * e + E * H + D * v + C * h;
        c[14] = F * d + E * G + D * u + C * f;
        c[3] = t * i + r * J + q * B + o * k;
        c[7] = t * g + r * I + q * A + o * j;
        c[11] = t * e + r * H + q * v + o * h;
        c[15] = t * d + r * G + q * u + o * f;
        return this
    },
    multiplyToArray: function(d, c, e) {
        var f = this.elements;
        this.multiplyMatrices(d, c);
        e[0] = f[0];
        e[1] = f[1];
        e[2] = f[2];
        e[3] = f[3];
        e[4] = f[4];
        e[5] = f[5];
        e[6] = f[6];
        e[7] = f[7];
        e[8] = f[8];
        e[9] = f[9];
        e[10] = f[10];
        e[11] = f[11];
        e[12] = f[12];
        e[13] = f[13];
        e[14] = f[14];
        e[15] = f[15];
        return this
    },
    multiplyScalar: function(a) {
        var b = this.elements;
        b[0] *= a;
        b[4] *= a;
        b[8] *= a;
        b[12] *= a;
        b[1] *= a;
        b[5] *= a;
        b[9] *= a;
        b[13] *= a;
        b[2] *= a;
        b[6] *= a;
        b[10] *= a;
        b[14] *= a;
        b[3] *= a;
        b[7] *= a;
        b[11] *= a;
        b[15] *= a;
        return this
    },
    multiplyVector3: function(a) {
        console.warn("THREE.Matrix4: .multiplyVector3() has been removed. Use vector.applyMatrix4( matrix ) or vector.applyProjection( matrix ) instead.");
        return a.applyProjection(this)
    },
    multiplyVector4: function(a) {
        console.warn("THREE.Matrix4: .multiplyVector4() has been removed. Use vector.applyMatrix4( matrix ) instead.");
        return a.applyMatrix4(this)
    },
    multiplyVector3Array: function(b) {
        console.warn("THREE.Matrix4: .multiplyVector3Array() has been renamed. Use matrix.applyToVector3Array( array ) instead.");
        return this.applyToVector3Array(b)
    },
    applyToVector3Array: function() {
        var a = new THREE.Vector3();
        return function(g, f, e) {
            if (f === undefined) {
                f = 0
            }
            if (e === undefined) {
                e = g.length
            }
            for (var d = 0, c = f, b; d < e; d += 3, c += 3) {
                a.x = g[c];
                a.y = g[c + 1];
                a.z = g[c + 2];
                a.applyMatrix4(this);
                g[c] = a.x;
                g[c + 1] = a.y;
                g[c + 2] = a.z
            }
            return g
        }
    }(),
    rotateAxis: function(a) {
        console.warn("THREE.Matrix4: .rotateAxis() has been removed. Use Vector3.transformDirection( matrix ) instead.");
        a.transformDirection(this)
    },
    crossVector: function(a) {
        console.warn("THREE.Matrix4: .crossVector() has been removed. Use vector.applyMatrix4( matrix ) instead.");
        return a.applyMatrix4(this)
    },
    determinant: function() {
        var c = this.elements;
        var n = c[0],
            m = c[4],
            k = c[8],
            i = c[12];
        var f = c[1],
            e = c[5],
            d = c[9],
            b = c[13];
        var a = c[2],
            q = c[6],
            p = c[10],
            o = c[14];
        var l = c[3],
            j = c[7],
            h = c[11],
            g = c[15];
        return (l * (+i * d * q - k * b * q - i * e * p + m * b * p + k * e * o - m * d * o) + j * (+n * d * o - n * b * p + i * f * p - k * f * o + k * b * a - i * d * a) + h * (+n * b * q - n * e * o - i * f * q + m * f * o + i * e * a - m * b * a) + g * (-k * e * a - n * d * q + n * e * p + k * f * q - m * f * p + m * d * a))
    },
    transpose: function() {
        var b = this.elements;
        var a;
        a = b[1];
        b[1] = b[4];
        b[4] = a;
        a = b[2];
        b[2] = b[8];
        b[8] = a;
        a = b[6];
        b[6] = b[9];
        b[9] = a;
        a = b[3];
        b[3] = b[12];
        b[12] = a;
        a = b[7];
        b[7] = b[13];
        b[13] = a;
        a = b[11];
        b[11] = b[14];
        b[14] = a;
        return this
    },
    flattenToArrayOffset: function(c, b) {
        var a = this.elements;
        c[b] = a[0];
        c[b + 1] = a[1];
        c[b + 2] = a[2];
        c[b + 3] = a[3];
        c[b + 4] = a[4];
        c[b + 5] = a[5];
        c[b + 6] = a[6];
        c[b + 7] = a[7];
        c[b + 8] = a[8];
        c[b + 9] = a[9];
        c[b + 10] = a[10];
        c[b + 11] = a[11];
        c[b + 12] = a[12];
        c[b + 13] = a[13];
        c[b + 14] = a[14];
        c[b + 15] = a[15];
        return c
    },
    getPosition: function() {
        var a = new THREE.Vector3();
        return function() {
            console.warn("THREE.Matrix4: .getPosition() has been removed. Use Vector3.setFromMatrixPosition( matrix ) instead.");
            var b = this.elements;
            return a.set(b[12], b[13], b[14])
        }
    }(),
    setPosition: function(a) {
        var b = this.elements;
        b[12] = a.x;
        b[13] = a.y;
        b[14] = a.z;
        return this
    },
    getInverse: function(r, h) {
        var g = this.elements;
        var A = r.elements;
        var p = A[0],
            n = A[4],
            k = A[8],
            i = A[12];
        var v = A[1],
            u = A[5],
            t = A[9],
            s = A[13];
        var d = A[2],
            c = A[6],
            b = A[10],
            a = A[14];
        var q = A[3],
            o = A[7],
            l = A[11],
            j = A[15];
        g[0] = t * a * o - s * b * o + s * c * l - u * a * l - t * c * j + u * b * j;
        g[4] = i * b * o - k * a * o - i * c * l + n * a * l + k * c * j - n * b * j;
        g[8] = k * s * o - i * t * o + i * u * l - n * s * l - k * u * j + n * t * j;
        g[12] = i * t * c - k * s * c - i * u * b + n * s * b + k * u * a - n * t * a;
        g[1] = s * b * q - t * a * q - s * d * l + v * a * l + t * d * j - v * b * j;
        g[5] = k * a * q - i * b * q + i * d * l - p * a * l - k * d * j + p * b * j;
        g[9] = i * t * q - k * s * q - i * v * l + p * s * l + k * v * j - p * t * j;
        g[13] = k * s * d - i * t * d + i * v * b - p * s * b - k * v * a + p * t * a;
        g[2] = u * a * q - s * c * q + s * d * o - v * a * o - u * d * j + v * c * j;
        g[6] = i * c * q - n * a * q - i * d * o + p * a * o + n * d * j - p * c * j;
        g[10] = n * s * q - i * u * q + i * v * o - p * s * o - n * v * j + p * u * j;
        g[14] = i * u * d - n * s * d - i * v * c + p * s * c + n * v * a - p * u * a;
        g[3] = t * c * q - u * b * q - t * d * o + v * b * o + u * d * l - v * c * l;
        g[7] = n * b * q - k * c * q + k * d * o - p * b * o - n * d * l + p * c * l;
        g[11] = k * u * q - n * t * q - k * v * o + p * t * o + n * v * l - p * u * l;
        g[15] = n * t * d - k * u * d + k * v * c - p * t * c - n * v * b + p * u * b;
        var e = p * g[0] + v * g[4] + d * g[8] + q * g[12];
        if (e == 0) {
            var f = "Matrix4.getInverse(): can't invert matrix, determinant is 0";
            if (h || false) {
                throw new Error(f)
            } else {
                console.warn(f)
            }
            this.identity();
            return this
        }
        this.multiplyScalar(1 / e);
        return this
    },
    translate: function(a) {
        console.warn("THREE.Matrix4: .translate() has been removed.")
    },
    rotateX: function(a) {
        console.warn("THREE.Matrix4: .rotateX() has been removed.")
    },
    rotateY: function(a) {
        console.warn("THREE.Matrix4: .rotateY() has been removed.")
    },
    rotateZ: function(a) {
        console.warn("THREE.Matrix4: .rotateZ() has been removed.")
    },
    rotateByAxis: function(a, b) {
        console.warn("THREE.Matrix4: .rotateByAxis() has been removed.")
    },
    scale: function(b) {
        var d = this.elements;
        var a = b.x,
            e = b.y,
            c = b.z;
        d[0] *= a;
        d[4] *= e;
        d[8] *= c;
        d[1] *= a;
        d[5] *= e;
        d[9] *= c;
        d[2] *= a;
        d[6] *= e;
        d[10] *= c;
        d[3] *= a;
        d[7] *= e;
        d[11] *= c;
        return this
    },
    getMaxScaleOnAxis: function() {
        var c = this.elements;
        var d = c[0] * c[0] + c[1] * c[1] + c[2] * c[2];
        var b = c[4] * c[4] + c[5] * c[5] + c[6] * c[6];
        var a = c[8] * c[8] + c[9] * c[9] + c[10] * c[10];
        return Math.sqrt(Math.max(d, Math.max(b, a)))
    },
    makeTranslation: function(a, c, b) {
        this.set(1, 0, 0, a, 0, 1, 0, c, 0, 0, 1, b, 0, 0, 0, 1);
        return this
    },
    makeRotationX: function(a) {
        var d = Math.cos(a),
            b = Math.sin(a);
        this.set(1, 0, 0, 0, 0, d, -b, 0, 0, b, d, 0, 0, 0, 0, 1);
        return this
    },
    makeRotationY: function(a) {
        var d = Math.cos(a),
            b = Math.sin(a);
        this.set(d, 0, b, 0, 0, 1, 0, 0, -b, 0, d, 0, 0, 0, 0, 1);
        return this
    },
    makeRotationZ: function(a) {
        var d = Math.cos(a),
            b = Math.sin(a);
        this.set(d, -b, 0, 0, b, d, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
        return this
    },
    makeRotationAxis: function(a, b) {
        var f = Math.cos(b);
        var k = Math.sin(b);
        var j = 1 - f;
        var i = a.x,
            h = a.y,
            g = a.z;
        var e = j * i,
            d = j * h;
        this.set(e * i + f, e * h - k * g, e * g + k * h, 0, e * h + k * g, d * h + f, d * g - k * i, 0, e * g - k * h, d * g + k * i, j * g * g + f, 0, 0, 0, 0, 1);
        return this
    },
    makeScale: function(a, c, b) {
        this.set(a, 0, 0, 0, 0, c, 0, 0, 0, 0, b, 0, 0, 0, 0, 1);
        return this
    },
    compose: function(a, b, c) {
        this.makeRotationFromQuaternion(b);
        this.scale(c);
        this.setPosition(a);
        return this
    },
    decompose: function() {
        var a = new THREE.Vector3();
        var b = new THREE.Matrix4();
        return function(i, h, g) {
            var f = this.elements;
            var m = a.set(f[0], f[1], f[2]).length();
            var l = a.set(f[4], f[5], f[6]).length();
            var k = a.set(f[8], f[9], f[10]).length();
            var j = this.determinant();
            if (j < 0) {
                m = -m
            }
            i.x = f[12];
            i.y = f[13];
            i.z = f[14];
            b.elements.set(this.elements);
            var e = 1 / m;
            var d = 1 / l;
            var c = 1 / k;
            b.elements[0] *= e;
            b.elements[1] *= e;
            b.elements[2] *= e;
            b.elements[4] *= d;
            b.elements[5] *= d;
            b.elements[6] *= d;
            b.elements[8] *= c;
            b.elements[9] *= c;
            b.elements[10] *= c;
            h.setFromRotationMatrix(b);
            g.x = m;
            g.y = l;
            g.z = k;
            return this
        }
    }(),
    makeFrustum: function(g, q, e, n, i, h) {
        var f = this.elements;
        var p = 2 * i / (q - g);
        var m = 2 * i / (n - e);
        var o = (q + g) / (q - g);
        var l = (n + e) / (n - e);
        var k = -(h + i) / (h - i);
        var j = -2 * h * i / (h - i);
        f[0] = p;
        f[4] = 0;
        f[8] = o;
        f[12] = 0;
        f[1] = 0;
        f[5] = m;
        f[9] = l;
        f[13] = 0;
        f[2] = 0;
        f[6] = 0;
        f[10] = k;
        f[14] = j;
        f[3] = 0;
        f[7] = 0;
        f[11] = -1;
        f[15] = 0;
        return this
    },
    makePerspective: function(e, c, g, b) {
        var a = g * Math.tan(THREE.Math.degToRad(e * 0.5));
        var f = -a;
        var h = f * c;
        var d = a * c;
        return this.makeFrustum(h, d, f, a, g, b)
    },
    makeOrthographic: function(d, n, k, a, g, f) {
        var c = this.elements;
        var m = n - d;
        var e = k - a;
        var b = f - g;
        var l = (n + d) / m;
        var j = (k + a) / e;
        var i = (f + g) / b;
        c[0] = 2 / m;
        c[4] = 0;
        c[8] = 0;
        c[12] = -l;
        c[1] = 0;
        c[5] = 2 / e;
        c[9] = 0;
        c[13] = -j;
        c[2] = 0;
        c[6] = 0;
        c[10] = -2 / b;
        c[14] = -i;
        c[3] = 0;
        c[7] = 0;
        c[11] = 0;
        c[15] = 1;
        return this
    },
    fromArray: function(a) {
        this.elements.set(a);
        return this
    },
    toArray: function() {
        var a = this.elements;
        return [a[0], a[1], a[2], a[3], a[4], a[5], a[6], a[7], a[8], a[9], a[10], a[11], a[12], a[13], a[14], a[15]]
    },
    clone: function() {
        return new THREE.Matrix4().fromArray(this.elements)
    }
};
THREE.Ray = function(a, b) {
    this.origin = (a !== undefined) ? a : new THREE.Vector3();
    this.direction = (b !== undefined) ? b : new THREE.Vector3()
};
THREE.Ray.prototype = {
    constructor: THREE.Ray,
    set: function(a, b) {
        this.origin.copy(a);
        this.direction.copy(b);
        return this
    },
    copy: function(a) {
        this.origin.copy(a.origin);
        this.direction.copy(a.direction);
        return this
    },
    at: function(c, b) {
        var a = b || new THREE.Vector3();
        return a.copy(this.direction).multiplyScalar(c).add(this.origin)
    },
    recast: function() {
        var a = new THREE.Vector3();
        return function(b) {
            this.origin.copy(this.at(b, a));
            return this
        }
    }(),
    closestPointToPoint: function(b, c) {
        var a = c || new THREE.Vector3();
        a.subVectors(b, this.origin);
        var d = a.dot(this.direction);
        if (d < 0) {
            return a.copy(this.origin)
        }
        return a.copy(this.direction).multiplyScalar(d).add(this.origin)
    },
    distanceToPoint: function() {
        var a = new THREE.Vector3();
        return function(b) {
            var c = a.subVectors(b, this.origin).dot(this.direction);
            if (c < 0) {
                return this.origin.distanceTo(b)
            }
            a.copy(this.direction).multiplyScalar(c).add(this.origin);
            return a.distanceTo(b)
        }
    }(),
    distanceSqToSegment: function() {
        var b = new THREE.Vector3();
        var a = new THREE.Vector3();
        var c = new THREE.Vector3();
        return function(p, l, m, f) {
            b.copy(p).add(l).multiplyScalar(0.5);
            a.copy(l).sub(p).normalize();
            c.copy(this.origin).sub(b);
            var h = p.distanceTo(l) * 0.5;
            var d = -this.direction.dot(a);
            var n = c.dot(this.direction);
            var k = -c.dot(a);
            var j = c.lengthSq();
            var i = Math.abs(1 - d * d);
            var r, o, e, q;
            if (i > 0) {
                r = d * k - n;
                o = d * n - k;
                q = h * i;
                if (r >= 0) {
                    if (o >= -q) {
                        if (o <= q) {
                            var g = 1 / i;
                            r *= g;
                            o *= g;
                            e = r * (r + d * o + 2 * n) + o * (d * r + o + 2 * k) + j
                        } else {
                            o = h;
                            r = Math.max(0, -(d * o + n));
                            e = -r * r + o * (o + 2 * k) + j
                        }
                    } else {
                        o = -h;
                        r = Math.max(0, -(d * o + n));
                        e = -r * r + o * (o + 2 * k) + j
                    }
                } else {
                    if (o <= -q) {
                        r = Math.max(0, -(-d * h + n));
                        o = (r > 0) ? -h : Math.min(Math.max(-h, -k), h);
                        e = -r * r + o * (o + 2 * k) + j
                    } else {
                        if (o <= q) {
                            r = 0;
                            o = Math.min(Math.max(-h, -k), h);
                            e = o * (o + 2 * k) + j
                        } else {
                            r = Math.max(0, -(d * h + n));
                            o = (r > 0) ? h : Math.min(Math.max(-h, -k), h);
                            e = -r * r + o * (o + 2 * k) + j
                        }
                    }
                }
            } else {
                o = (d > 0) ? -h : h;
                r = Math.max(0, -(d * o + n));
                e = -r * r + o * (o + 2 * k) + j
            }
            if (m) {
                m.copy(this.direction).multiplyScalar(r).add(this.origin)
            }
            if (f) {
                f.copy(a).multiplyScalar(o).add(b)
            }
            return e
        }
    }(),
    isIntersectionSphere: function(a) {
        return this.distanceToPoint(a.center) <= a.radius
    },
    intersectSphere: function() {
        var a = new THREE.Vector3();
        return function(b, d) {
            a.subVectors(b.center, this.origin);
            var i = a.dot(this.direction);
            var f = a.dot(a) - i * i;
            var c = b.radius * b.radius;
            if (f > c) {
                return null
            }
            var h = Math.sqrt(c - f);
            var g = i - h;
            var e = i + h;
            if (g < 0 && e < 0) {
                return null
            }
            if (g < 0) {
                return this.at(e, d)
            }
            return this.at(g, d)
        }
    }(),
    isIntersectionPlane: function(a) {
        var b = a.distanceToPoint(this.origin);
        if (b === 0) {
            return true
        }
        var c = a.normal.dot(this.direction);
        if (c * b < 0) {
            return true
        }
        return false
    },
    distanceToPlane: function(a) {
        var c = a.normal.dot(this.direction);
        if (c == 0) {
            if (a.distanceToPoint(this.origin) == 0) {
                return 0
            }
            return null
        }
        var b = -(this.origin.dot(a.normal) + a.constant) / c;
        return b >= 0 ? b : null
    },
    intersectPlane: function(a, c) {
        var b = this.distanceToPlane(a);
        if (b === null) {
            return null
        }
        return this.at(b, c)
    },
    isIntersectionBox: function() {
        var a = new THREE.Vector3();
        return function(b) {
            return this.intersectBox(b, a) !== null
        }
    }(),
    intersectBox: function(f, l) {
        var c, g, i, a, h, k;
        var e = 1 / this.direction.x,
            d = 1 / this.direction.y,
            b = 1 / this.direction.z;
        var j = this.origin;
        if (e >= 0) {
            c = (f.min.x - j.x) * e;
            g = (f.max.x - j.x) * e
        } else {
            c = (f.max.x - j.x) * e;
            g = (f.min.x - j.x) * e
        }
        if (d >= 0) {
            i = (f.min.y - j.y) * d;
            a = (f.max.y - j.y) * d
        } else {
            i = (f.max.y - j.y) * d;
            a = (f.min.y - j.y) * d
        }
        if ((c > a) || (i > g)) {
            return null
        }
        if (i > c || c !== c) {
            c = i
        }
        if (a < g || g !== g) {
            g = a
        }
        if (b >= 0) {
            h = (f.min.z - j.z) * b;
            k = (f.max.z - j.z) * b
        } else {
            h = (f.max.z - j.z) * b;
            k = (f.min.z - j.z) * b
        }
        if ((c > k) || (h > g)) {
            return null
        }
        if (h > c || c !== c) {
            c = h
        }
        if (k < g || g !== g) {
            g = k
        }
        if (g < 0) {
            return null
        }
        return this.at(c >= 0 ? c : g, l)
    },
    intersectTriangle: function() {
        var d = new THREE.Vector3();
        var b = new THREE.Vector3();
        var a = new THREE.Vector3();
        var c = new THREE.Vector3();
        return function(m, k, j, e, n) {
            b.subVectors(k, m);
            a.subVectors(j, m);
            c.crossVectors(b, a);
            var i = this.direction.dot(c);
            var f;
            if (i > 0) {
                if (e) {
                    return null
                }
                f = 1
            } else {
                if (i < 0) {
                    f = -1;
                    i = -i
                } else {
                    return null
                }
            }
            d.subVectors(this.origin, m);
            var l = f * this.direction.dot(a.crossVectors(d, a));
            if (l < 0) {
                return null
            }
            var g = f * this.direction.dot(b.cross(d));
            if (g < 0) {
                return null
            }
            if (l + g > i) {
                return null
            }
            var h = -f * d.dot(c);
            if (h < 0) {
                return null
            }
            return this.at(h / i, n)
        }
    }(),
    applyMatrix4: function(a) {
        this.direction.add(this.origin).applyMatrix4(a);
        this.origin.applyMatrix4(a);
        this.direction.sub(this.origin);
        this.direction.normalize();
        return this
    },
    equals: function(a) {
        return a.origin.equals(this.origin) && a.direction.equals(this.direction)
    },
    clone: function() {
        return new THREE.Ray().copy(this)
    }
};
THREE.Sphere = function(b, a) {
    this.center = (b !== undefined) ? b : new THREE.Vector3();
    this.radius = (a !== undefined) ? a : 0
};
THREE.Sphere.prototype = {
    constructor: THREE.Sphere,
    set: function(b, a) {
        this.center.copy(b);
        this.radius = a;
        return this
    },
    setFromPoints: function() {
        var a = new THREE.Box3();
        return function(f, g) {
            var b = this.center;
            if (g !== undefined) {
                b.copy(g)
            } else {
                a.setFromPoints(f).center(b)
            }
            var c = 0;
            for (var e = 0, d = f.length; e < d; e++) {
                c = Math.max(c, b.distanceToSquared(f[e]))
            }
            this.radius = Math.sqrt(c);
            return this
        }
    }(),
    copy: function(a) {
        this.center.copy(a.center);
        this.radius = a.radius;
        return this
    },
    empty: function() {
        return (this.radius <= 0)
    },
    containsPoint: function(a) {
        return (a.distanceToSquared(this.center) <= (this.radius * this.radius))
    },
    distanceToPoint: function(a) {
        return (a.distanceTo(this.center) - this.radius)
    },
    intersectsSphere: function(a) {
        var b = this.radius + a.radius;
        return a.center.distanceToSquared(this.center) <= (b * b)
    },
    clampPoint: function(b, d) {
        var c = this.center.distanceToSquared(b);
        var a = d || new THREE.Vector3();
        a.copy(b);
        if (c > (this.radius * this.radius)) {
            a.sub(this.center).normalize();
            a.multiplyScalar(this.radius).add(this.center)
        }
        return a
    },
    getBoundingBox: function(a) {
        var b = a || new THREE.Box3();
        b.set(this.center, this.center);
        b.expandByScalar(this.radius);
        return b
    },
    applyMatrix4: function(a) {
        this.center.applyMatrix4(a);
        this.radius = this.radius * a.getMaxScaleOnAxis();
        return this
    },
    translate: function(a) {
        this.center.add(a);
        return this
    },
    equals: function(a) {
        return a.center.equals(this.center) && (a.radius === this.radius)
    },
    clone: function() {
        return new THREE.Sphere().copy(this)
    }
};
THREE.Frustum = function(f, e, d, c, b, a) {
    this.planes = [(f !== undefined) ? f : new THREE.Plane(), (e !== undefined) ? e : new THREE.Plane(), (d !== undefined) ? d : new THREE.Plane(), (c !== undefined) ? c : new THREE.Plane(), (b !== undefined) ? b : new THREE.Plane(), (a !== undefined) ? a : new THREE.Plane()]
};
THREE.Frustum.prototype = {
    constructor: THREE.Frustum,
    set: function(g, f, e, d, c, b) {
        var a = this.planes;
        a[0].copy(g);
        a[1].copy(f);
        a[2].copy(e);
        a[3].copy(d);
        a[4].copy(c);
        a[5].copy(b);
        return this
    },
    copy: function(c) {
        var a = this.planes;
        for (var b = 0; b < 6; b++) {
            a[b].copy(c.planes[b])
        }
        return this
    },
    setFromMatrix: function(o) {
        var h = this.planes;
        var t = o.elements;
        var l = t[0],
            j = t[1],
            i = t[2],
            g = t[3];
        var f = t[4],
            e = t[5],
            d = t[6],
            c = t[7];
        var b = t[8],
            a = t[9],
            s = t[10],
            r = t[11];
        var q = t[12],
            p = t[13],
            n = t[14],
            k = t[15];
        h[0].setComponents(g - l, c - f, r - b, k - q).normalize();
        h[1].setComponents(g + l, c + f, r + b, k + q).normalize();
        h[2].setComponents(g + j, c + e, r + a, k + p).normalize();
        h[3].setComponents(g - j, c - e, r - a, k - p).normalize();
        h[4].setComponents(g - i, c - d, r - s, k - n).normalize();
        h[5].setComponents(g + i, c + d, r + s, k + n).normalize();
        return this
    },
    intersectsObject: function() {
        var a = new THREE.Sphere();
        return function(b) {
            var c = b.geometry;
            if (c.boundingSphere === null) {
                c.computeBoundingSphere()
            }
            a.copy(c.boundingSphere);
            a.applyMatrix4(b.matrixWorld);
            return this.intersectsSphere(a)
        }
    }(),
    intersectsSphere: function(c) {
        var d = this.planes;
        var a = c.center;
        var b = -c.radius;
        for (var e = 0; e < 6; e++) {
            var f = d[e].distanceToPoint(a);
            if (f < b) {
                return false
            }
        }
        return true
    },
    intersectsBox: function() {
        var b = new THREE.Vector3(),
            a = new THREE.Vector3();
        return function(g) {
            var d = this.planes;
            for (var e = 0; e < 6; e++) {
                var c = d[e];
                b.x = c.normal.x > 0 ? g.min.x : g.max.x;
                a.x = c.normal.x > 0 ? g.max.x : g.min.x;
                b.y = c.normal.y > 0 ? g.min.y : g.max.y;
                a.y = c.normal.y > 0 ? g.max.y : g.min.y;
                b.z = c.normal.z > 0 ? g.min.z : g.max.z;
                a.z = c.normal.z > 0 ? g.max.z : g.min.z;
                var h = c.distanceToPoint(b);
                var f = c.distanceToPoint(a);
                if (h < 0 && f < 0) {
                    return false
                }
            }
            return true
        }
    }(),
    containsPoint: function(a) {
        var b = this.planes;
        for (var c = 0; c < 6; c++) {
            if (b[c].distanceToPoint(a) < 0) {
                return false
            }
        }
        return true
    },
    clone: function() {
        return new THREE.Frustum().copy(this)
    }
};
THREE.Plane = function(b, a) {
    this.normal = (b !== undefined) ? b : new THREE.Vector3(1, 0, 0);
    this.constant = (a !== undefined) ? a : 0
};
THREE.Plane.prototype = {
    constructor: THREE.Plane,
    set: function(b, a) {
        this.normal.copy(b);
        this.constant = a;
        return this
    },
    setComponents: function(a, d, c, b) {
        this.normal.set(a, d, c);
        this.constant = b;
        return this
    },
    setFromNormalAndCoplanarPoint: function(b, a) {
        this.normal.copy(b);
        this.constant = -a.dot(this.normal);
        return this
    },
    setFromCoplanarPoints: function() {
        var b = new THREE.Vector3();
        var a = new THREE.Vector3();
        return function(e, d, g) {
            var f = b.subVectors(g, d).cross(a.subVectors(e, d)).normalize();
            this.setFromNormalAndCoplanarPoint(f, e);
            return this
        }
    }(),
    copy: function(a) {
        this.normal.copy(a.normal);
        this.constant = a.constant;
        return this
    },
    normalize: function() {
        var a = 1 / this.normal.length();
        this.normal.multiplyScalar(a);
        this.constant *= a;
        return this
    },
    negate: function() {
        this.constant *= -1;
        this.normal.negate();
        return this
    },
    distanceToPoint: function(a) {
        return this.normal.dot(a) + this.constant
    },
    distanceToSphere: function(a) {
        return this.distanceToPoint(a.center) - a.radius
    },
    projectPoint: function(a, b) {
        return this.orthoPoint(a, b).sub(a).negate()
    },
    orthoPoint: function(b, d) {
        var c = this.distanceToPoint(b);
        var a = d || new THREE.Vector3();
        return a.copy(this.normal).multiplyScalar(c)
    },
    isIntersectionLine: function(a) {
        var c = this.distanceToPoint(a.start);
        var b = this.distanceToPoint(a.end);
        return (c < 0 && b > 0) || (b < 0 && c > 0)
    },
    intersectLine: function() {
        var a = new THREE.Vector3();
        return function(c, e) {
            var b = e || new THREE.Vector3();
            var f = c.delta(a);
            var g = this.normal.dot(f);
            if (g == 0) {
                if (this.distanceToPoint(c.start) == 0) {
                    return b.copy(c.start)
                }
                return undefined
            }
            var d = -(c.start.dot(this.normal) + this.constant) / g;
            if (d < 0 || d > 1) {
                return undefined
            }
            return b.copy(f).multiplyScalar(d).add(c.start)
        }
    }(),
    coplanarPoint: function(b) {
        var a = b || new THREE.Vector3();
        return a.copy(this.normal).multiplyScalar(-this.constant)
    },
    applyMatrix4: function() {
        var c = new THREE.Vector3();
        var b = new THREE.Vector3();
        var a = new THREE.Matrix3();
        return function(e, f) {
            var h = f || a.getNormalMatrix(e);
            var g = c.copy(this.normal).applyMatrix3(h);
            var d = this.coplanarPoint(b);
            d.applyMatrix4(e);
            this.setFromNormalAndCoplanarPoint(g, d);
            return this
        }
    }(),
    translate: function(a) {
        this.constant = this.constant - a.dot(this.normal);
        return this
    },
    equals: function(a) {
        return a.normal.equals(this.normal) && (a.constant == this.constant)
    },
    clone: function() {
        return new THREE.Plane().copy(this)
    }
};
THREE.Math = {
    generateUUID: function() {
        var d = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz".split("");
        var b = new Array(36);
        var a = 0,
            c;
        return function() {
            for (var e = 0; e < 36; e++) {
                if (e == 8 || e == 13 || e == 18 || e == 23) {
                    b[e] = "-"
                } else {
                    if (e == 14) {
                        b[e] = "4"
                    } else {
                        if (a <= 2) {
                            a = 33554432 + (Math.random() * 16777216) | 0
                        }
                        c = a & 15;
                        a = a >> 4;
                        b[e] = d[(e == 19) ? (c & 3) | 8 : c]
                    }
                }
            }
            return b.join("")
        }
    }(),
    clamp: function(d, e, c) {
        return (d < e) ? e : ((d > c) ? c : d)
    },
    clampBottom: function(b, c) {
        return b < c ? c : b
    },
    mapLinear: function(b, c, a, e, d) {
        return e + (b - c) * (d - e) / (a - c)
    },
    smoothstep: function(b, c, a) {
        if (b <= c) {
            return 0
        }
        if (b >= a) {
            return 1
        }
        b = (b - c) / (a - c);
        return b * b * (3 - 2 * b)
    },
    smootherstep: function(b, c, a) {
        if (b <= c) {
            return 0
        }
        if (b >= a) {
            return 1
        }
        b = (b - c) / (a - c);
        return b * b * b * (b * (b * 6 - 15) + 10)
    },
    random16: function() {
        return (65280 * Math.random() + 255 * Math.random()) / 65535
    },
    randInt: function(a, b) {
        return Math.floor(this.randFloat(a, b))
    },
    randFloat: function(a, b) {
        return a + Math.random() * (b - a)
    },
    randFloatSpread: function(a) {
        return a * (0.5 - Math.random())
    },
    degToRad: function() {
        var a = Math.PI / 180;
        return function(b) {
            return b * a
        }
    }(),
    radToDeg: function() {
        var a = 180 / Math.PI;
        return function(b) {
            return b * a
        }
    }(),
    isPowerOfTwo: function(a) {
        return (a & (a - 1)) === 0 && a !== 0
    }
};
THREE.Spline = function(n) {
    this.points = n;
    var h = [],
        j = {
            x: 0,
            y: 0,
            z: 0
        },
        m, a, e, d, b, l, k, i, g;
    this.initFromArray = function(c) {
        this.points = [];
        for (var o = 0; o < c.length; o++) {
            this.points[o] = {
                x: c[o][0],
                y: c[o][1],
                z: c[o][2]
            }
        }
    };
    this.getPoint = function(c) {
        m = (this.points.length - 1) * c;
        a = Math.floor(m);
        e = m - a;
        h[0] = a === 0 ? a : a - 1;
        h[1] = a;
        h[2] = a > this.points.length - 2 ? this.points.length - 1 : a + 1;
        h[3] = a > this.points.length - 3 ? this.points.length - 1 : a + 2;
        l = this.points[h[0]];
        k = this.points[h[1]];
        i = this.points[h[2]];
        g = this.points[h[3]];
        d = e * e;
        b = e * d;
        j.x = f(l.x, k.x, i.x, g.x, e, d, b);
        j.y = f(l.y, k.y, i.y, g.y, e, d, b);
        j.z = f(l.z, k.z, i.z, g.z, e, d, b);
        return j
    };
    this.getControlPointsArray = function() {
        var o, r, c = this.points.length,
            q = [];
        for (o = 0; o < c; o++) {
            r = this.points[o];
            q[o] = [r.x, r.y, r.z]
        }
        return q
    };
    this.getLength = function(p) {
        var r, t, u, s, B = 0,
            c = 0,
            q = 0,
            A = new THREE.Vector3(),
            o = new THREE.Vector3(),
            v = [],
            C = 0;
        v[0] = 0;
        if (!p) {
            p = 100
        }
        u = this.points.length * p;
        A.copy(this.points[0]);
        for (r = 1; r < u; r++) {
            t = r / u;
            s = this.getPoint(t);
            o.copy(s);
            C += o.distanceTo(A);
            A.copy(s);
            B = (this.points.length - 1) * t;
            c = Math.floor(B);
            if (c != q) {
                v[c] = C;
                q = c
            }
        }
        v[v.length] = C;
        return {
            chunks: v,
            total: C
        }
    };
    this.reparametrizeByArcLength = function(p) {
        var t, s, A, B, q, o, C, v, u, D = [],
            c = new THREE.Vector3(),
            r = this.getLength();
        D.push(c.copy(this.points[0]).clone());
        for (t = 1; t < this.points.length; t++) {
            C = r.chunks[t] - r.chunks[t - 1];
            v = Math.ceil(p * C / r.total);
            B = (t - 1) / (this.points.length - 1);
            q = t / (this.points.length - 1);
            for (s = 1; s < v - 1; s++) {
                A = B + s * (1 / v) * (q - B);
                u = this.getPoint(A);
                D.push(c.copy(u).clone())
            }
            D.push(c.copy(this.points[t]).clone())
        }
        this.points = D
    };

    function f(v, u, r, q, A, o, c) {
        var s = (r - v) * 0.5,
            p = (q - u) * 0.5;
        return (2 * (u - r) + s + p) * c + (-3 * (u - r) - 2 * s - p) * o + s * A + u
    }
};
THREE.Triangle = function(e, d, f) {
    this.a = (e !== undefined) ? e : new THREE.Vector3();
    this.b = (d !== undefined) ? d : new THREE.Vector3();
    this.c = (f !== undefined) ? f : new THREE.Vector3()
};
THREE.Triangle.normal = function() {
    var a = new THREE.Vector3();
    return function(g, e, i, h) {
        var d = h || new THREE.Vector3();
        d.subVectors(i, e);
        a.subVectors(g, e);
        d.cross(a);
        var f = d.lengthSq();
        if (f > 0) {
            return d.multiplyScalar(1 / Math.sqrt(f))
        }
        return d.set(0, 0, 0)
    }
}();
THREE.Triangle.barycoordFromPoint = function() {
    var a = new THREE.Vector3();
    var c = new THREE.Vector3();
    var b = new THREE.Vector3();
    return function(n, m, k, h, r) {
        a.subVectors(h, m);
        c.subVectors(k, m);
        b.subVectors(n, m);
        var l = a.dot(a);
        var j = a.dot(c);
        var i = a.dot(b);
        var f = c.dot(c);
        var d = c.dot(b);
        var g = (l * f - j * j);
        var q = r || new THREE.Vector3();
        if (g == 0) {
            return q.set(-2, -1, -1)
        }
        var e = 1 / g;
        var p = (f * i - j * d) * e;
        var o = (l * d - j * i) * e;
        return q.set(1 - p - o, o, p)
    }
}();
THREE.Triangle.containsPoint = function() {
    var a = new THREE.Vector3();
    return function(f, g, e, h) {
        var d = THREE.Triangle.barycoordFromPoint(f, g, e, h, a);
        return (d.x >= 0) && (d.y >= 0) && ((d.x + d.y) <= 1)
    }
}();
THREE.Triangle.prototype = {
    constructor: THREE.Triangle,
    set: function(e, d, f) {
        this.a.copy(e);
        this.b.copy(d);
        this.c.copy(f);
        return this
    },
    setFromPointsAndIndices: function(b, d, c, a) {
        this.a.copy(b[d]);
        this.b.copy(b[c]);
        this.c.copy(b[a]);
        return this
    },
    copy: function(a) {
        this.a.copy(a.a);
        this.b.copy(a.b);
        this.c.copy(a.c);
        return this
    },
    area: function() {
        var a = new THREE.Vector3();
        var b = new THREE.Vector3();
        return function() {
            a.subVectors(this.c, this.b);
            b.subVectors(this.a, this.b);
            return a.cross(b).length() * 0.5
        }
    }(),
    midpoint: function(b) {
        var a = b || new THREE.Vector3();
        return a.addVectors(this.a, this.b).add(this.c).multiplyScalar(1 / 3)
    },
    normal: function(a) {
        return THREE.Triangle.normal(this.a, this.b, this.c, a)
    },
    plane: function(b) {
        var a = b || new THREE.Plane();
        return a.setFromCoplanarPoints(this.a, this.b, this.c)
    },
    barycoordFromPoint: function(a, b) {
        return THREE.Triangle.barycoordFromPoint(a, this.a, this.b, this.c, b)
    },
    containsPoint: function(a) {
        return THREE.Triangle.containsPoint(a, this.a, this.b, this.c)
    },
    equals: function(a) {
        return a.a.equals(this.a) && a.b.equals(this.b) && a.c.equals(this.c)
    },
    clone: function() {
        return new THREE.Triangle().copy(this)
    }
};
THREE.Clock = function(a) {
    this.autoStart = (a !== undefined) ? a : true;
    this.startTime = 0;
    this.oldTime = 0;
    this.elapsedTime = 0;
    this.running = false
};
THREE.Clock.prototype = {
    constructor: THREE.Clock,
    start: function() {
        this.startTime = self.performance !== undefined && self.performance.now !== undefined ? self.performance.now() : Date.now();
        this.oldTime = this.startTime;
        this.running = true
    },
    stop: function() {
        this.getElapsedTime();
        this.running = false
    },
    getElapsedTime: function() {
        this.getDelta();
        return this.elapsedTime
    },
    getDelta: function() {
        var b = 0;
        if (this.autoStart && !this.running) {
            this.start()
        }
        if (this.running) {
            var a = self.performance !== undefined && self.performance.now !== undefined ? self.performance.now() : Date.now();
            b = 0.001 * (a - this.oldTime);
            this.oldTime = a;
            this.elapsedTime += b
        }
        return b
    }
};
THREE.EventDispatcher = function() {};
THREE.EventDispatcher.prototype = {
    constructor: THREE.EventDispatcher,
    apply: function(a) {
        a.addEventListener = THREE.EventDispatcher.prototype.addEventListener;
        a.hasEventListener = THREE.EventDispatcher.prototype.hasEventListener;
        a.removeEventListener = THREE.EventDispatcher.prototype.removeEventListener;
        a.dispatchEvent = THREE.EventDispatcher.prototype.dispatchEvent
    },
    addEventListener: function(b, c) {
        if (this._listeners === undefined) {
            this._listeners = {}
        }
        var a = this._listeners;
        if (a[b] === undefined) {
            a[b] = []
        }
        if (a[b].indexOf(c) === -1) {
            a[b].push(c)
        }
    },
    hasEventListener: function(b, c) {
        if (this._listeners === undefined) {
            return false
        }
        var a = this._listeners;
        if (a[b] !== undefined && a[b].indexOf(c) !== -1) {
            return true
        }
        return false
    },
    removeEventListener: function(d, e) {
        if (this._listeners === undefined) {
            return
        }
        var c = this._listeners;
        var a = c[d];
        if (a !== undefined) {
            var b = a.indexOf(e);
            if (b !== -1) {
                a.splice(b, 1)
            }
        }
    },
    dispatchEvent: function(e) {
        if (this._listeners === undefined) {
            return
        }
        var c = this._listeners;
        var a = c[e.type];
        if (a !== undefined) {
            e.target = this;
            var f = [];
            var d = a.length;
            for (var b = 0; b < d; b++) {
                f[b] = a[b]
            }
            for (var b = 0; b < d; b++) {
                f[b].call(this, e)
            }
        }
    }
};
(function(c) {
    c.Raycaster = function(e, g, f, d) {
        this.ray = new c.Ray(e, g);
        this.near = f || 0;
        this.far = d || Infinity;
        this.params = {
            Sprite: {},
            Mesh: {},
            PointCloud: {
                threshold: 1
            },
            LOD: {},
            Line: {}
        }
    };
    var b = function(e, d) {
        return e.distance - d.distance
    };
    var a = function(g, e, k, f) {
        g.raycast(e, k);
        if (f === true) {
            var j = g.children;
            for (var h = 0, d = j.length; h < d; h++) {
                a(j[h], e, k, true)
            }
        }
    };
    c.Raycaster.prototype = {
        constructor: c.Raycaster,
        precision: 0.0001,
        linePrecision: 1,
        set: function(d, e) {
            this.ray.set(d, e)
        },
        setFromCamera: function(e, d) {
            if (d instanceof c.PerspectiveCamera) {
                this.ray.origin.copy(d.position);
                this.ray.direction.set(e.x, e.y, 0.5).unproject(d).sub(d.position).normalize()
            } else {
                if (d instanceof c.OrthographicCamera) {
                    this.ray.origin.set(e.x, e.y, -1).unproject(d);
                    this.ray.direction.set(0, 0, -1).transformDirection(d.matrixWorld)
                } else {
                    console.error("THREE.Raycaster: Unsupported camera type.")
                }
            }
        },
        intersectObject: function(e, d) {
            var f = [];
            a(e, this, f, d);
            f.sort(b);
            return f
        },
        intersectObjects: function(h, e) {
            var g = [];
            if (h instanceof Array === false) {
                return g
            }
            for (var f = 0, d = h.length; f < d; f++) {
                a(h[f], this, g, e)
            }
            g.sort(b);
            return g
        }
    }
}(THREE));
THREE.Object3D = function() {
    Object.defineProperty(this, "id", {
        value: THREE.Object3DIdCount++
    });
    this.uuid = THREE.Math.generateUUID();
    this.name = "";
    this.type = "Object3D";
    this.parent = undefined;
    this.children = [];
    this.up = THREE.Object3D.DefaultUp.clone();
    var d = this;
    var a = new THREE.Vector3();
    var c = new THREE.Euler();
    var f = new THREE.Quaternion();
    var g = new THREE.Vector3(1, 1, 1);
    var e = function() {
        f.setFromEuler(c, false)
    };
    var b = function() {
        c.setFromQuaternion(f, undefined, false)
    };
    c.onChange(e);
    f.onChange(b);
    Object.defineProperties(this, {
        position: {
            enumerable: true,
            value: a
        },
        rotation: {
            enumerable: true,
            value: c
        },
        quaternion: {
            enumerable: true,
            value: f
        },
        scale: {
            enumerable: true,
            value: g
        }
    });
    this.rotationAutoUpdate = true;
    this.matrix = new THREE.Matrix4();
    this.matrixWorld = new THREE.Matrix4();
    this.matrixAutoUpdate = true;
    this.matrixWorldNeedsUpdate = false;
    this.visible = true;
    this.castShadow = false;
    this.receiveShadow = false;
    this.frustumCulled = true;
    this.userData = {}
};
THREE.Object3D.DefaultUp = new THREE.Vector3(0, 1, 0);
THREE.Object3D.prototype = {
    constructor: THREE.Object3D,
    get eulerOrder() {
        console.warn("THREE.Object3D: .eulerOrder has been moved to .rotation.order.");
        return this.rotation.order
    },
    set eulerOrder(a) {
        console.warn("THREE.Object3D: .eulerOrder has been moved to .rotation.order.");
        this.rotation.order = a
    },
    get useQuaternion() {
        console.warn("THREE.Object3D: .useQuaternion has been removed. The library now uses quaternions by default.")
    },
    set useQuaternion(a) {
        console.warn("THREE.Object3D: .useQuaternion has been removed. The library now uses quaternions by default.")
    },
    applyMatrix: function(a) {
        this.matrix.multiplyMatrices(a, this.matrix);
        this.matrix.decompose(this.position, this.quaternion, this.scale)
    },
    setRotationFromAxisAngle: function(a, b) {
        this.quaternion.setFromAxisAngle(a, b)
    },
    setRotationFromEuler: function(a) {
        this.quaternion.setFromEuler(a, true)
    },
    setRotationFromMatrix: function(a) {
        this.quaternion.setFromRotationMatrix(a)
    },
    setRotationFromQuaternion: function(a) {
        this.quaternion.copy(a)
    },
    rotateOnAxis: function() {
        var a = new THREE.Quaternion();
        return function(b, c) {
            a.setFromAxisAngle(b, c);
            this.quaternion.multiply(a);
            return this
        }
    }(),
    rotateX: function() {
        var a = new THREE.Vector3(1, 0, 0);
        return function(b) {
            return this.rotateOnAxis(a, b)
        }
    }(),
    rotateY: function() {
        var a = new THREE.Vector3(0, 1, 0);
        return function(b) {
            return this.rotateOnAxis(a, b)
        }
    }(),
    rotateZ: function() {
        var a = new THREE.Vector3(0, 0, 1);
        return function(b) {
            return this.rotateOnAxis(a, b)
        }
    }(),
    translateOnAxis: function() {
        var a = new THREE.Vector3();
        return function(b, c) {
            a.copy(b).applyQuaternion(this.quaternion);
            this.position.add(a.multiplyScalar(c));
            return this
        }
    }(),
    translate: function(b, a) {
        console.warn("THREE.Object3D: .translate() has been removed. Use .translateOnAxis( axis, distance ) instead.");
        return this.translateOnAxis(a, b)
    },
    translateX: function() {
        var a = new THREE.Vector3(1, 0, 0);
        return function(b) {
            return this.translateOnAxis(a, b)
        }
    }(),
    translateY: function() {
        var a = new THREE.Vector3(0, 1, 0);
        return function(b) {
            return this.translateOnAxis(a, b)
        }
    }(),
    translateZ: function() {
        var a = new THREE.Vector3(0, 0, 1);
        return function(b) {
            return this.translateOnAxis(a, b)
        }
    }(),
    localToWorld: function(a) {
        return a.applyMatrix4(this.matrixWorld)
    },
    worldToLocal: function() {
        var a = new THREE.Matrix4();
        return function(b) {
            return b.applyMatrix4(a.getInverse(this.matrixWorld))
        }
    }(),
    lookAt: function() {
        var a = new THREE.Matrix4();
        return function(b) {
            a.lookAt(b, this.position, this.up);
            this.quaternion.setFromRotationMatrix(a)
        }
    }(),
    add: function(a) {
        if (arguments.length > 1) {
            for (var b = 0; b < arguments.length; b++) {
                this.add(arguments[b])
            }
            return this
        }
        if (a === this) {
            console.error("THREE.Object3D.add:", a, "can't be added as a child of itself.");
            return this
        }
        if (a instanceof THREE.Object3D) {
            if (a.parent !== undefined) {
                a.parent.remove(a)
            }
            a.parent = this;
            a.dispatchEvent({
                type: "added"
            });
            this.children.push(a)
        } else {
            console.error("THREE.Object3D.add:", a, "is not an instance of THREE.Object3D.")
        }
        return this
    },
    remove: function(b) {
        if (arguments.length > 1) {
            for (var c = 0; c < arguments.length; c++) {
                this.remove(arguments[c])
            }
        }
        var a = this.children.indexOf(b);
        if (a !== -1) {
            b.parent = undefined;
            b.dispatchEvent({
                type: "removed"
            });
            this.children.splice(a, 1)
        }
    },
    getChildByName: function(b, a) {
        console.warn("THREE.Object3D: .getChildByName() has been renamed to .getObjectByName().");
        return this.getObjectByName(b, a)
    },
    getObjectById: function(b, a) {
        return this.getObjectByProperty("id", b, a)
    },
    getObjectByName: function(b, a) {
        return this.getObjectByProperty("name", b, a)
    },
    getObjectByProperty: function(d, f, c) {
        if (this[d] === f) {
            return this
        }
        for (var e = 0, a = this.children.length; e < a; e++) {
            var g = this.children[e];
            var b = g.getObjectByProperty(d, f, c);
            if (b !== undefined) {
                return b
            }
        }
        return undefined
    },
    getWorldPosition: function(b) {
        var a = b || new THREE.Vector3();
        this.updateMatrixWorld(true);
        return a.setFromMatrixPosition(this.matrixWorld)
    },
    getWorldQuaternion: function() {
        var a = new THREE.Vector3();
        var b = new THREE.Vector3();
        return function(d) {
            var c = d || new THREE.Quaternion();
            this.updateMatrixWorld(true);
            this.matrixWorld.decompose(a, c, b);
            return c
        }
    }(),
    getWorldRotation: function() {
        var a = new THREE.Quaternion();
        return function(c) {
            var b = c || new THREE.Euler();
            this.getWorldQuaternion(a);
            return b.setFromQuaternion(a, this.rotation.order, false)
        }
    }(),
    getWorldScale: function() {
        var a = new THREE.Vector3();
        var b = new THREE.Quaternion();
        return function(d) {
            var c = d || new THREE.Vector3();
            this.updateMatrixWorld(true);
            this.matrixWorld.decompose(a, b, c);
            return c
        }
    }(),
    getWorldDirection: function() {
        var a = new THREE.Quaternion();
        return function(c) {
            var b = c || new THREE.Vector3();
            this.getWorldQuaternion(a);
            return b.set(0, 0, 1).applyQuaternion(a)
        }
    }(),
    raycast: function() {},
    traverse: function(c) {
        c(this);
        for (var b = 0, a = this.children.length; b < a; b++) {
            this.children[b].traverse(c)
        }
    },
    traverseVisible: function(c) {
        if (this.visible === false) {
            return
        }
        c(this);
        for (var b = 0, a = this.children.length; b < a; b++) {
            this.children[b].traverseVisible(c)
        }
    },
    traverseAncestors: function(a) {
        if (this.parent) {
            a(this.parent);
            this.parent.traverseAncestors(a)
        }
    },
    updateMatrix: function() {
        this.matrix.compose(this.position, this.quaternion, this.scale);
        this.matrixWorldNeedsUpdate = true
    },
    updateMatrixWorld: function(c) {
        if (this.matrixAutoUpdate === true) {
            this.updateMatrix()
        }
        if (this.matrixWorldNeedsUpdate === true || c === true) {
            if (this.parent === undefined) {
                this.matrixWorld.copy(this.matrix)
            } else {
                this.matrixWorld.multiplyMatrices(this.parent.matrixWorld, this.matrix)
            }
            this.matrixWorldNeedsUpdate = false;
            c = true
        }
        for (var b = 0, a = this.children.length; b < a; b++) {
            this.children[b].updateMatrixWorld(c)
        }
    },
    toJSON: function() {
        var d = {
            metadata: {
                version: 4.3,
                type: "Object",
                generator: "ObjectExporter"
            }
        };
        var e = {};
        var f = function(h) {
            if (d.geometries === undefined) {
                d.geometries = []
            }
            if (e[h.uuid] === undefined) {
                var g = h.toJSON();
                delete g.metadata;
                e[h.uuid] = g;
                d.geometries.push(g)
            }
            return h.uuid
        };
        var c = {};
        var a = function(h) {
            if (d.materials === undefined) {
                d.materials = []
            }
            if (c[h.uuid] === undefined) {
                var g = h.toJSON();
                delete g.metadata;
                c[h.uuid] = g;
                d.materials.push(g)
            }
            return h.uuid
        };
        var b = function(g) {
            var j = {};
            j.uuid = g.uuid;
            j.type = g.type;
            if (g.name !== "") {
                j.name = g.name
            }
            if (JSON.stringify(g.userData) !== "{}") {
                j.userData = g.userData
            }
            if (g.visible !== true) {
                j.visible = g.visible
            }
            if (g instanceof THREE.PerspectiveCamera) {
                j.fov = g.fov;
                j.aspect = g.aspect;
                j.near = g.near;
                j.far = g.far
            } else {
                if (g instanceof THREE.OrthographicCamera) {
                    j.left = g.left;
                    j.right = g.right;
                    j.top = g.top;
                    j.bottom = g.bottom;
                    j.near = g.near;
                    j.far = g.far
                } else {
                    if (g instanceof THREE.AmbientLight) {
                        j.color = g.color.getHex()
                    } else {
                        if (g instanceof THREE.DirectionalLight) {
                            j.color = g.color.getHex();
                            j.intensity = g.intensity
                        } else {
                            if (g instanceof THREE.PointLight) {
                                j.color = g.color.getHex();
                                j.intensity = g.intensity;
                                j.distance = g.distance
                            } else {
                                if (g instanceof THREE.SpotLight) {
                                    j.color = g.color.getHex();
                                    j.intensity = g.intensity;
                                    j.distance = g.distance;
                                    j.angle = g.angle;
                                    j.exponent = g.exponent
                                } else {
                                    if (g instanceof THREE.HemisphereLight) {
                                        j.color = g.color.getHex();
                                        j.groundColor = g.groundColor.getHex()
                                    } else {
                                        if (g instanceof THREE.Mesh) {
                                            j.geometry = f(g.geometry);
                                            j.material = a(g.material)
                                        } else {
                                            if (g instanceof THREE.Line) {
                                                j.geometry = f(g.geometry);
                                                j.material = a(g.material)
                                            } else {
                                                if (g instanceof THREE.Sprite) {
                                                    j.material = a(g.material)
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            j.matrix = g.matrix.toArray();
            if (g.children.length > 0) {
                j.children = [];
                for (var h = 0; h < g.children.length; h++) {
                    j.children.push(b(g.children[h]))
                }
            }
            return j
        };
        d.object = b(this);
        return d
    },
    clone: function(b, a) {
        if (b === undefined) {
            b = new THREE.Object3D()
        }
        if (a === undefined) {
            a = true
        }
        b.name = this.name;
        b.up.copy(this.up);
        b.position.copy(this.position);
        b.quaternion.copy(this.quaternion);
        b.scale.copy(this.scale);
        b.rotationAutoUpdate = this.rotationAutoUpdate;
        b.matrix.copy(this.matrix);
        b.matrixWorld.copy(this.matrixWorld);
        b.matrixAutoUpdate = this.matrixAutoUpdate;
        b.matrixWorldNeedsUpdate = this.matrixWorldNeedsUpdate;
        b.visible = this.visible;
        b.castShadow = this.castShadow;
        b.receiveShadow = this.receiveShadow;
        b.frustumCulled = this.frustumCulled;
        b.userData = JSON.parse(JSON.stringify(this.userData));
        if (a === true) {
            for (var c = 0; c < this.children.length; c++) {
                var d = this.children[c];
                b.add(d.clone())
            }
        }
        return b
    }
};
THREE.EventDispatcher.prototype.apply(THREE.Object3D.prototype);
THREE.Object3DIdCount = 0;
THREE.Face3 = function(f, e, i, h, g, d) {
    this.a = f;
    this.b = e;
    this.c = i;
    this.normal = h instanceof THREE.Vector3 ? h : new THREE.Vector3();
    this.vertexNormals = h instanceof Array ? h : [];
    this.color = g instanceof THREE.Color ? g : new THREE.Color();
    this.vertexColors = g instanceof Array ? g : [];
    this.vertexTangents = [];
    this.materialIndex = d !== undefined ? d : 0
};
THREE.Face3.prototype = {
    constructor: THREE.Face3,
    clone: function() {
        var c = new THREE.Face3(this.a, this.b, this.c);
        c.normal.copy(this.normal);
        c.color.copy(this.color);
        c.materialIndex = this.materialIndex;
        for (var b = 0, a = this.vertexNormals.length; b < a; b++) {
            c.vertexNormals[b] = this.vertexNormals[b].clone()
        }
        for (var b = 0, a = this.vertexColors.length; b < a; b++) {
            c.vertexColors[b] = this.vertexColors[b].clone()
        }
        for (var b = 0, a = this.vertexTangents.length; b < a; b++) {
            c.vertexTangents[b] = this.vertexTangents[b].clone()
        }
        return c
    }
};
THREE.Face4 = function(g, f, k, j, i, h, e) {
    console.warn("THREE.Face4 has been removed. A THREE.Face3 will be created instead.");
    return new THREE.Face3(g, f, k, i, h, e)
};
THREE.BufferAttribute = function(b, a) {
    this.array = b;
    this.itemSize = a;
    this.needsUpdate = false
};
THREE.BufferAttribute.prototype = {
    constructor: THREE.BufferAttribute,
    get length() {
        return this.array.length
    },
    copyAt: function(e, c, d) {
        e *= this.itemSize;
        d *= c.itemSize;
        for (var b = 0, a = this.itemSize; b < a; b++) {
            this.array[e + b] = c.array[d + b]
        }
    },
    set: function(a) {
        this.array.set(a);
        return this
    },
    setX: function(b, a) {
        this.array[b * this.itemSize] = a;
        return this
    },
    setY: function(a, b) {
        this.array[a * this.itemSize + 1] = b;
        return this
    },
    setZ: function(a, b) {
        this.array[a * this.itemSize + 2] = b;
        return this
    },
    setXY: function(b, a, c) {
        b *= this.itemSize;
        this.array[b] = a;
        this.array[b + 1] = c;
        return this
    },
    setXYZ: function(b, a, d, c) {
        b *= this.itemSize;
        this.array[b] = a;
        this.array[b + 1] = d;
        this.array[b + 2] = c;
        return this
    },
    setXYZW: function(c, a, e, d, b) {
        c *= this.itemSize;
        this.array[c] = a;
        this.array[c + 1] = e;
        this.array[c + 2] = d;
        this.array[c + 3] = b;
        return this
    },
    clone: function() {
        return new THREE.BufferAttribute(new this.array.constructor(this.array), this.itemSize)
    }
};
THREE.Int8Attribute = function(a, b) {
    console.warn("THREE.Int8Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Uint8Attribute = function(a, b) {
    console.warn("THREE.Uint8Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Uint8ClampedAttribute = function(a, b) {
    console.warn("THREE.Uint8ClampedAttribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Int16Attribute = function(a, b) {
    console.warn("THREE.Int16Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Uint16Attribute = function(a, b) {
    console.warn("THREE.Uint16Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Int32Attribute = function(a, b) {
    console.warn("THREE.Int32Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Uint32Attribute = function(a, b) {
    console.warn("THREE.Uint32Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Float32Attribute = function(a, b) {
    console.warn("THREE.Float32Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.Float64Attribute = function(a, b) {
    console.warn("THREE.Float64Attribute has been removed. Use THREE.BufferAttribute( array, itemSize ) instead.");
    return new THREE.BufferAttribute(a, b)
};
THREE.BufferGeometry = function() {
    Object.defineProperty(this, "id", {
        value: THREE.GeometryIdCount++
    });
    this.uuid = THREE.Math.generateUUID();
    this.name = "";
    this.type = "BufferGeometry";
    this.attributes = {};
    this.attributesKeys = [];
    this.drawcalls = [];
    this.offsets = this.drawcalls;
    this.boundingBox = null;
    this.boundingSphere = null
};
THREE.BufferGeometry.prototype = {
    constructor: THREE.BufferGeometry,
    addAttribute: function(a, b) {
        if (b instanceof THREE.BufferAttribute === false) {
            console.warn("THREE.BufferGeometry: .addAttribute() now expects ( name, attribute ).");
            this.attributes[a] = {
                array: arguments[1],
                itemSize: arguments[2]
            };
            return
        }
        this.attributes[a] = b;
        this.attributesKeys = Object.keys(this.attributes)
    },
    getAttribute: function(a) {
        return this.attributes[a]
    },
    addDrawCall: function(c, a, b) {
        this.drawcalls.push({
            start: c,
            count: a,
            index: b !== undefined ? b : 0
        })
    },
    applyMatrix: function(b) {
        var a = this.attributes.position;
        if (a !== undefined) {
            b.applyToVector3Array(a.array);
            a.needsUpdate = true
        }
        var c = this.attributes.normal;
        if (c !== undefined) {
            var d = new THREE.Matrix3().getNormalMatrix(b);
            d.applyToVector3Array(c.array);
            c.needsUpdate = true
        }
    },
    center: function() {},
    fromGeometry: function(f, F) {
        F = F || {
            vertexColors: THREE.NoColors
        };
        var g = f.vertices;
        var e = f.faces;
        var E = f.faceVertexUvs;
        var s = F.vertexColors;
        var d = E[0].length > 0;
        var M = e[0].vertexNormals.length == 3;
        var k = new Float32Array(e.length * 3 * 3);
        this.addAttribute("position", new THREE.BufferAttribute(k, 3));
        var q = new Float32Array(e.length * 3 * 3);
        this.addAttribute("normal", new THREE.BufferAttribute(q, 3));
        if (s !== THREE.NoColors) {
            var o = new Float32Array(e.length * 3 * 3);
            this.addAttribute("color", new THREE.BufferAttribute(o, 3))
        }
        if (d === true) {
            var p = new Float32Array(e.length * 3 * 2);
            this.addAttribute("uv", new THREE.BufferAttribute(p, 2))
        }
        for (var A = 0, v = 0, u = 0; A < e.length; A++, v += 6, u += 9) {
            var m = e[A];
            var L = g[m.a];
            var K = g[m.b];
            var I = g[m.c];
            k[u] = L.x;
            k[u + 1] = L.y;
            k[u + 2] = L.z;
            k[u + 3] = K.x;
            k[u + 4] = K.y;
            k[u + 5] = K.z;
            k[u + 6] = I.x;
            k[u + 7] = I.y;
            k[u + 8] = I.z;
            if (M === true) {
                var l = m.vertexNormals[0];
                var j = m.vertexNormals[1];
                var h = m.vertexNormals[2];
                q[u] = l.x;
                q[u + 1] = l.y;
                q[u + 2] = l.z;
                q[u + 3] = j.x;
                q[u + 4] = j.y;
                q[u + 5] = j.z;
                q[u + 6] = h.x;
                q[u + 7] = h.y;
                q[u + 8] = h.z
            } else {
                var t = m.normal;
                q[u] = t.x;
                q[u + 1] = t.y;
                q[u + 2] = t.z;
                q[u + 3] = t.x;
                q[u + 4] = t.y;
                q[u + 5] = t.z;
                q[u + 6] = t.x;
                q[u + 7] = t.y;
                q[u + 8] = t.z
            }
            if (s === THREE.FaceColors) {
                var r = m.color;
                o[u] = r.r;
                o[u + 1] = r.g;
                o[u + 2] = r.b;
                o[u + 3] = r.r;
                o[u + 4] = r.g;
                o[u + 5] = r.b;
                o[u + 6] = r.r;
                o[u + 7] = r.g;
                o[u + 8] = r.b
            } else {
                if (s === THREE.VertexColors) {
                    var J = m.vertexColors[0];
                    var H = m.vertexColors[1];
                    var G = m.vertexColors[2];
                    o[u] = J.r;
                    o[u + 1] = J.g;
                    o[u + 2] = J.b;
                    o[u + 3] = H.r;
                    o[u + 4] = H.g;
                    o[u + 5] = H.b;
                    o[u + 6] = G.r;
                    o[u + 7] = G.g;
                    o[u + 8] = G.b
                }
            }
            if (d === true) {
                var D = E[0][A][0];
                var C = E[0][A][1];
                var B = E[0][A][2];
                p[v] = D.x;
                p[v + 1] = D.y;
                p[v + 2] = C.x;
                p[v + 3] = C.y;
                p[v + 4] = B.x;
                p[v + 5] = B.y
            }
        }
        this.computeBoundingSphere();
        return this
    },
    computeBoundingBox: function() {
        var a = new THREE.Vector3();
        return function() {
            if (this.boundingBox === null) {
                this.boundingBox = new THREE.Box3()
            }
            var b = this.attributes.position.array;
            if (b) {
                var e = this.boundingBox;
                e.makeEmpty();
                for (var d = 0, c = b.length; d < c; d += 3) {
                    a.set(b[d], b[d + 1], b[d + 2]);
                    e.expandByPoint(a)
                }
            }
            if (b === undefined || b.length === 0) {
                this.boundingBox.min.set(0, 0, 0);
                this.boundingBox.max.set(0, 0, 0)
            }
            if (isNaN(this.boundingBox.min.x) || isNaN(this.boundingBox.min.y) || isNaN(this.boundingBox.min.z)) {
                console.error('THREE.BufferGeometry.computeBoundingBox: Computed min/max have NaN values. The "position" attribute is likely to have NaN values.')
            }
        }
    }(),
    computeBoundingSphere: function() {
        var b = new THREE.Box3();
        var a = new THREE.Vector3();
        return function() {
            if (this.boundingSphere === null) {
                this.boundingSphere = new THREE.Sphere()
            }
            var e = this.attributes.position.array;
            if (e) {
                b.makeEmpty();
                var c = this.boundingSphere.center;
                for (var g = 0, f = e.length; g < f; g += 3) {
                    a.set(e[g], e[g + 1], e[g + 2]);
                    b.expandByPoint(a)
                }
                b.center(c);
                var d = 0;
                for (var g = 0, f = e.length; g < f; g += 3) {
                    a.set(e[g], e[g + 1], e[g + 2]);
                    d = Math.max(d, c.distanceToSquared(a))
                }
                this.boundingSphere.radius = Math.sqrt(d);
                if (isNaN(this.boundingSphere.radius)) {
                    console.error('THREE.BufferGeometry.computeBoundingSphere(): Computed radius is NaN. The "position" attribute is likely to have NaN values.')
                }
            }
        }
    }(),
    computeFaceNormals: function() {},
    computeVertexNormals: function() {
        var g = this.attributes;
        if (g.position) {
            var f = g.position.array;
            if (g.normal === undefined) {
                this.addAttribute("normal", new THREE.BufferAttribute(new Float32Array(f.length), 3))
            } else {
                var k = g.normal.array;
                for (var r = 0, h = k.length; r < h; r++) {
                    k[r] = 0
                }
            }
            var k = g.normal.array;
            var u, s, q, p = new THREE.Vector3(),
                n = new THREE.Vector3(),
                m = new THREE.Vector3(),
                l = new THREE.Vector3(),
                v = new THREE.Vector3();
            if (g.index) {
                var b = g.index.array;
                var c = (this.offsets.length > 0 ? this.offsets : [{
                    start: 0,
                    count: b.length,
                    index: 0
                }]);
                for (var o = 0, t = c.length; o < t; ++o) {
                    var a = c[o].start;
                    var e = c[o].count;
                    var d = c[o].index;
                    for (var r = a, h = a + e; r < h; r += 3) {
                        u = (d + b[r]) * 3;
                        s = (d + b[r + 1]) * 3;
                        q = (d + b[r + 2]) * 3;
                        p.fromArray(f, u);
                        n.fromArray(f, s);
                        m.fromArray(f, q);
                        l.subVectors(m, n);
                        v.subVectors(p, n);
                        l.cross(v);
                        k[u] += l.x;
                        k[u + 1] += l.y;
                        k[u + 2] += l.z;
                        k[s] += l.x;
                        k[s + 1] += l.y;
                        k[s + 2] += l.z;
                        k[q] += l.x;
                        k[q + 1] += l.y;
                        k[q + 2] += l.z
                    }
                }
            } else {
                for (var r = 0, h = f.length; r < h; r += 9) {
                    p.fromArray(f, r);
                    n.fromArray(f, r + 3);
                    m.fromArray(f, r + 6);
                    l.subVectors(m, n);
                    v.subVectors(p, n);
                    l.cross(v);
                    k[r] = l.x;
                    k[r + 1] = l.y;
                    k[r + 2] = l.z;
                    k[r + 3] = l.x;
                    k[r + 4] = l.y;
                    k[r + 5] = l.z;
                    k[r + 6] = l.x;
                    k[r + 7] = l.y;
                    k[r + 8] = l.z
                }
            }
            this.normalizeNormals();
            g.normal.needsUpdate = true
        }
    },
    computeTangents: function() {
        if (this.attributes.index === undefined || this.attributes.position === undefined || this.attributes.normal === undefined || this.attributes.uv === undefined) {
            console.warn("Missing required attributes (index, position, normal or uv) in BufferGeometry.computeTangents()");
            return
        }
        var d = this.attributes.index.array;
        var o = this.attributes.position.array;
        var u = this.attributes.normal.array;
        var L = this.attributes.uv.array;
        var s = o.length / 3;
        if (this.attributes.tangent === undefined) {
            this.addAttribute("tangent", new THREE.BufferAttribute(new Float32Array(4 * s), 4))
        }
        var B = this.attributes.tangent.array;
        var ad = [],
            ac = [];
        for (var V = 0; V < s; V++) {
            ad[V] = new THREE.Vector3();
            ac[V] = new THREE.Vector3()
        }
        var S = new THREE.Vector3(),
            P = new THREE.Vector3(),
            O = new THREE.Vector3(),
            l = new THREE.Vector2(),
            h = new THREE.Vector2(),
            g = new THREE.Vector2(),
            q, p, af, ae, J, I, aa, Z, H, G, Q;
        var e = new THREE.Vector3(),
            D = new THREE.Vector3();

        function K(j, i, k) {
            S.fromArray(o, j * 3);
            P.fromArray(o, i * 3);
            O.fromArray(o, k * 3);
            l.fromArray(L, j * 2);
            h.fromArray(L, i * 2);
            g.fromArray(L, k * 2);
            q = P.x - S.x;
            p = O.x - S.x;
            af = P.y - S.y;
            ae = O.y - S.y;
            J = P.z - S.z;
            I = O.z - S.z;
            aa = h.x - l.x;
            Z = g.x - l.x;
            H = h.y - l.y;
            G = g.y - l.y;
            Q = 1 / (aa * G - Z * H);
            e.set((G * q - H * p) * Q, (G * af - H * ae) * Q, (G * J - H * I) * Q);
            D.set((aa * p - Z * q) * Q, (aa * ae - Z * af) * Q, (aa * I - Z * J) * Q);
            ad[j].add(e);
            ad[i].add(e);
            ad[k].add(e);
            ac[j].add(D);
            ac[i].add(D);
            ac[k].add(D)
        }
        var X, E;
        var W, m;
        var c, b, a;
        if (this.drawcalls.length === 0) {
            this.addDrawCall(0, d.length, 0)
        }
        var ab = this.drawcalls;
        for (W = 0, m = ab.length; W < m; ++W) {
            var A = ab[W].start;
            var R = ab[W].count;
            var F = ab[W].index;
            for (X = A, E = A + R; X < E; X += 3) {
                c = F + d[X];
                b = F + d[X + 1];
                a = F + d[X + 2];
                K(c, b, a)
            }
        }
        var T = new THREE.Vector3(),
            Y = new THREE.Vector3();
        var U = new THREE.Vector3(),
            C = new THREE.Vector3();
        var M, N, f;

        function v(i) {
            U.fromArray(u, i * 3);
            C.copy(U);
            N = ad[i];
            T.copy(N);
            T.sub(U.multiplyScalar(U.dot(N))).normalize();
            Y.crossVectors(C, N);
            f = Y.dot(ac[i]);
            M = (f < 0) ? -1 : 1;
            B[i * 4] = T.x;
            B[i * 4 + 1] = T.y;
            B[i * 4 + 2] = T.z;
            B[i * 4 + 3] = M
        }
        for (W = 0, m = ab.length; W < m; ++W) {
            var A = ab[W].start;
            var R = ab[W].count;
            var F = ab[W].index;
            for (X = A, E = A + R; X < E; X += 3) {
                c = F + d[X];
                b = F + d[X + 1];
                a = F + d[X + 2];
                v(c);
                v(b);
                v(a)
            }
        }
    },
    computeOffsets: function(b) {
        var q = b;
        if (b === undefined) {
            q = 65535
        }
        var p = Date.now();
        var h = this.attributes.index.array;
        var l = this.attributes.position.array;
        var e = (l.length / 3);
        var o = (h.length / 3);
        var r = new Uint16Array(h.length);
        var a = 0;
        var d = 0;
        var k = [{
            start: 0,
            count: 0,
            index: 0
        }];
        var i = k[0];
        var c = 0;
        var g = 0;
        var u = new Int32Array(6);
        var F = new Int32Array(l.length);
        var E = new Int32Array(l.length);
        for (var A = 0; A < l.length; A++) {
            F[A] = -1;
            E[A] = -1
        }
        for (var B = 0; B < o; B++) {
            g = 0;
            for (var C = 0; C < 3; C++) {
                var D = h[B * 3 + C];
                if (F[D] == -1) {
                    u[C * 2] = D;
                    u[C * 2 + 1] = -1;
                    g++
                } else {
                    if (F[D] < i.index) {
                        u[C * 2] = D;
                        u[C * 2 + 1] = -1;
                        c++
                    } else {
                        u[C * 2] = D;
                        u[C * 2 + 1] = F[D]
                    }
                }
            }
            var m = d + g;
            if (m > (i.index + q)) {
                var t = {
                    start: a,
                    count: 0,
                    index: d
                };
                k.push(t);
                i = t;
                for (var n = 0; n < 6; n += 2) {
                    var f = u[n + 1];
                    if (f > -1 && f < i.index) {
                        u[n + 1] = -1
                    }
                }
            }
            for (var n = 0; n < 6; n += 2) {
                var D = u[n];
                var f = u[n + 1];
                if (f === -1) {
                    f = d++
                }
                F[D] = f;
                E[f] = D;
                r[a++] = f - i.index;
                i.count++
            }
        }
        this.reorderBuffers(r, E, d);
        this.offsets = k;
        return k
    },
    merge: function(l, f) {
        if (l instanceof THREE.BufferGeometry === false) {
            console.error("THREE.BufferGeometry.merge(): geometry not an instance of THREE.BufferGeometry.", l);
            return
        }
        if (f === undefined) {
            f = 0
        }
        var g = this.attributes;
        for (var m in g) {
            if (l.attributes[m] === undefined) {
                continue
            }
            var d = g[m];
            var b = d.array;
            var c = l.attributes[m];
            var a = c.array;
            var k = c.itemSize;
            for (var h = 0, e = k * f; h < a.length; h++, e++) {
                b[e] = a[h]
            }
        }
        return this
    },
    normalizeNormals: function() {
        var d = this.attributes.normal.array;
        var a, g, e, f;
        for (var c = 0, b = d.length; c < b; c += 3) {
            a = d[c];
            g = d[c + 1];
            e = d[c + 2];
            f = 1 / Math.sqrt(a * a + g * g + e * e);
            d[c] *= f;
            d[c + 1] *= f;
            d[c + 2] *= f
        }
    },
    reorderBuffers: function(f, j, a) {
        var e = {};
        for (var i in this.attributes) {
            if (i == "index") {
                continue
            }
            var h = this.attributes[i].array;
            e[i] = new h.constructor(this.attributes[i].itemSize * a)
        }
        for (var b = 0; b < a; b++) {
            var l = j[b];
            for (var i in this.attributes) {
                if (i == "index") {
                    continue
                }
                var c = this.attributes[i].array;
                var g = this.attributes[i].itemSize;
                var m = e[i];
                for (var d = 0; d < g; d++) {
                    m[b * g + d] = c[l * g + d]
                }
            }
        }
        this.attributes.index.array = f;
        for (var i in this.attributes) {
            if (i == "index") {
                continue
            }
            this.attributes[i].array = e[i];
            this.attributes[i].numItems = this.attributes[i].itemSize * a
        }
    },
    toJSON: function() {
        var b = {
            metadata: {
                version: 4,
                type: "BufferGeometry",
                generator: "BufferGeometryExporter"
            },
            uuid: this.uuid,
            type: this.type,
            data: {
                attributes: {}
            }
        };
        var e = this.attributes;
        var d = this.offsets;
        var j = this.boundingSphere;
        for (var k in e) {
            var a = e[k];
            var g = [],
                h = a.array;
            for (var f = 0, c = h.length; f < c; f++) {
                g[f] = h[f]
            }
            b.data.attributes[k] = {
                itemSize: a.itemSize,
                type: a.array.constructor.name,
                array: g
            }
        }
        if (d.length > 0) {
            b.data.offsets = JSON.parse(JSON.stringify(d))
        }
        if (j !== null) {
            b.data.boundingSphere = {
                center: j.center.toArray(),
                radius: j.radius
            }
        }
        return b
    },
    clone: function() {
        var e = new THREE.BufferGeometry();
        for (var a in this.attributes) {
            var f = this.attributes[a];
            e.addAttribute(a, f.clone())
        }
        for (var c = 0, b = this.offsets.length; c < b; c++) {
            var d = this.offsets[c];
            e.offsets.push({
                start: d.start,
                index: d.index,
                count: d.count
            })
        }
        return e
    },
    dispose: function() {
        this.dispatchEvent({
            type: "dispose"
        })
    }
};
THREE.EventDispatcher.prototype.apply(THREE.BufferGeometry.prototype);
THREE.Geometry = function() {
    Object.defineProperty(this, "id", {
        value: THREE.GeometryIdCount++
    });
    this.uuid = THREE.Math.generateUUID();
    this.name = "";
    this.type = "Geometry";
    this.vertices = [];
    this.colors = [];
    this.faces = [];
    this.faceVertexUvs = [
        []
    ];
    this.morphTargets = [];
    this.morphColors = [];
    this.morphNormals = [];
    this.skinWeights = [];
    this.skinIndices = [];
    this.lineDistances = [];
    this.boundingBox = null;
    this.boundingSphere = null;
    this.hasTangents = false;
    this.dynamic = true;
    this.verticesNeedUpdate = false;
    this.elementsNeedUpdate = false;
    this.uvsNeedUpdate = false;
    this.normalsNeedUpdate = false;
    this.tangentsNeedUpdate = false;
    this.colorsNeedUpdate = false;
    this.lineDistancesNeedUpdate = false;
    this.groupsNeedUpdate = false
};
THREE.Geometry.prototype = {
    constructor: THREE.Geometry,
    applyMatrix: function(b) {
        var h = new THREE.Matrix3().getNormalMatrix(b);
        for (var e = 0, a = this.vertices.length; e < a; e++) {
            var g = this.vertices[e];
            g.applyMatrix4(b)
        }
        for (var e = 0, a = this.faces.length; e < a; e++) {
            var f = this.faces[e];
            f.normal.applyMatrix3(h).normalize();
            for (var c = 0, d = f.vertexNormals.length; c < d; c++) {
                f.vertexNormals[c].applyMatrix3(h).normalize()
            }
        }
        if (this.boundingBox instanceof THREE.Box3) {
            this.computeBoundingBox()
        }
        if (this.boundingSphere instanceof THREE.Sphere) {
            this.computeBoundingSphere()
        }
    },
    fromBufferGeometry: function(k) {
        var o = this;
        var d = k.attributes;
        var g = d.position.array;
        var n = d.index !== undefined ? d.index.array : undefined;
        var l = d.normal !== undefined ? d.normal.array : undefined;
        var a = d.color !== undefined ? d.color.array : undefined;
        var c = d.uv !== undefined ? d.uv.array : undefined;
        var h = [];
        var m = [];
        for (var e = 0, b = 0; e < g.length; e += 3, b += 2) {
            o.vertices.push(new THREE.Vector3(g[e], g[e + 1], g[e + 2]));
            if (l !== undefined) {
                h.push(new THREE.Vector3(l[e], l[e + 1], l[e + 2]))
            }
            if (a !== undefined) {
                o.colors.push(new THREE.Color(a[e], a[e + 1], a[e + 2]))
            }
            if (c !== undefined) {
                m.push(new THREE.Vector2(c[b], c[b + 1]))
            }
        }
        var f = function(j, i, r) {
            var p = l !== undefined ? [h[j].clone(), h[i].clone(), h[r].clone()] : [];
            var q = a !== undefined ? [o.colors[j].clone(), o.colors[i].clone(), o.colors[r].clone()] : [];
            o.faces.push(new THREE.Face3(j, i, r, p, q));
            if (c !== undefined) {
                o.faceVertexUvs[0].push([m[j].clone(), m[i].clone(), m[r].clone()])
            }
        };
        if (n !== undefined) {
            for (var e = 0; e < n.length; e += 3) {
                f(n[e], n[e + 1], n[e + 2])
            }
        } else {
            for (var e = 0; e < g.length / 3; e += 3) {
                f(e, e + 1, e + 2)
            }
        }
        this.computeFaceNormals();
        if (k.boundingBox !== null) {
            this.boundingBox = k.boundingBox.clone()
        }
        if (k.boundingSphere !== null) {
            this.boundingSphere = k.boundingSphere.clone()
        }
        return this
    },
    center: function() {
        this.computeBoundingBox();
        var a = new THREE.Vector3();
        a.addVectors(this.boundingBox.min, this.boundingBox.max);
        a.multiplyScalar(-0.5);
        this.applyMatrix(new THREE.Matrix4().makeTranslation(a.x, a.y, a.z));
        this.computeBoundingBox();
        return a
    },
    computeFaceNormals: function() {
        var a = new THREE.Vector3(),
            i = new THREE.Vector3();
        for (var h = 0, g = this.faces.length; h < g; h++) {
            var e = this.faces[h];
            var d = this.vertices[e.a];
            var c = this.vertices[e.b];
            var b = this.vertices[e.c];
            a.subVectors(b, c);
            i.subVectors(d, c);
            a.cross(i);
            a.normalize();
            e.normal.copy(a)
        }
    },
    computeVertexNormals: function(g) {
        var m, d, h, l, k, j;
        j = new Array(this.vertices.length);
        for (m = 0, d = this.vertices.length; m < d; m++) {
            j[m] = new THREE.Vector3()
        }
        if (g) {
            var c, b, a, q;
            var e = new THREE.Vector3(),
                p = new THREE.Vector3(),
                o = new THREE.Vector3(),
                n = new THREE.Vector3(),
                i = new THREE.Vector3();
            for (h = 0, l = this.faces.length; h < l; h++) {
                k = this.faces[h];
                c = this.vertices[k.a];
                b = this.vertices[k.b];
                a = this.vertices[k.c];
                e.subVectors(a, b);
                p.subVectors(c, b);
                e.cross(p);
                j[k.a].add(e);
                j[k.b].add(e);
                j[k.c].add(e)
            }
        } else {
            for (h = 0, l = this.faces.length; h < l; h++) {
                k = this.faces[h];
                j[k.a].add(k.normal);
                j[k.b].add(k.normal);
                j[k.c].add(k.normal)
            }
        }
        for (m = 0, d = this.vertices.length; m < d; m++) {
            j[m].normalize()
        }
        for (h = 0, l = this.faces.length; h < l; h++) {
            k = this.faces[h];
            k.vertexNormals[0] = j[k.a].clone();
            k.vertexNormals[1] = j[k.b].clone();
            k.vertexNormals[2] = j[k.c].clone()
        }
    },
    computeMorphNormals: function() {
        var e, l, g, m, h;
        for (g = 0, m = this.faces.length; g < m; g++) {
            h = this.faces[g];
            if (!h.__originalFaceNormal) {
                h.__originalFaceNormal = h.normal.clone()
            } else {
                h.__originalFaceNormal.copy(h.normal)
            }
            if (!h.__originalVertexNormals) {
                h.__originalVertexNormals = []
            }
            for (e = 0, l = h.vertexNormals.length; e < l; e++) {
                if (!h.__originalVertexNormals[e]) {
                    h.__originalVertexNormals[e] = h.vertexNormals[e].clone()
                } else {
                    h.__originalVertexNormals[e].copy(h.vertexNormals[e])
                }
            }
        }
        var c = new THREE.Geometry();
        c.faces = this.faces;
        for (e = 0, l = this.morphTargets.length; e < l; e++) {
            if (!this.morphNormals[e]) {
                this.morphNormals[e] = {};
                this.morphNormals[e].faceNormals = [];
                this.morphNormals[e].vertexNormals = [];
                var d = this.morphNormals[e].faceNormals;
                var a = this.morphNormals[e].vertexNormals;
                var k, b;
                for (g = 0, m = this.faces.length; g < m; g++) {
                    k = new THREE.Vector3();
                    b = {
                        a: new THREE.Vector3(),
                        b: new THREE.Vector3(),
                        c: new THREE.Vector3()
                    };
                    d.push(k);
                    a.push(b)
                }
            }
            var j = this.morphNormals[e];
            c.vertices = this.morphTargets[e].vertices;
            c.computeFaceNormals();
            c.computeVertexNormals();
            var k, b;
            for (g = 0, m = this.faces.length; g < m; g++) {
                h = this.faces[g];
                k = j.faceNormals[g];
                b = j.vertexNormals[g];
                k.copy(h.normal);
                b.a.copy(h.vertexNormals[0]);
                b.b.copy(h.vertexNormals[1]);
                b.c.copy(h.vertexNormals[2])
            }
        }
        for (g = 0, m = this.faces.length; g < m; g++) {
            h = this.faces[g];
            h.normal = h.__originalFaceNormal;
            h.vertexNormals = h.__originalVertexNormals
        }
    },
    computeTangents: function() {
        var O, m, E, k, N, p, C, g, o, K, H, G, e, d, c, j, h, V, U, A, u, R, Q, s, q, I, F, b, T = [],
            S = [],
            a = new THREE.Vector3(),
            l = new THREE.Vector3(),
            L = new THREE.Vector3(),
            P = new THREE.Vector3(),
            M = new THREE.Vector3(),
            D;
        for (E = 0, k = this.vertices.length; E < k; E++) {
            T[E] = new THREE.Vector3();
            S[E] = new THREE.Vector3()
        }

        function B(v, i, f, W, t, r, n) {
            K = v.vertices[i];
            H = v.vertices[f];
            G = v.vertices[W];
            e = o[t];
            d = o[r];
            c = o[n];
            j = H.x - K.x;
            h = G.x - K.x;
            V = H.y - K.y;
            U = G.y - K.y;
            A = H.z - K.z;
            u = G.z - K.z;
            R = d.x - e.x;
            Q = c.x - e.x;
            s = d.y - e.y;
            q = c.y - e.y;
            I = 1 / (R * q - Q * s);
            a.set((q * j - s * h) * I, (q * V - s * U) * I, (q * A - s * u) * I);
            l.set((R * h - Q * j) * I, (R * U - Q * V) * I, (R * u - Q * A) * I);
            T[i].add(a);
            T[f].add(a);
            T[W].add(a);
            S[i].add(l);
            S[f].add(l);
            S[W].add(l)
        }
        for (O = 0, m = this.faces.length; O < m; O++) {
            g = this.faces[O];
            o = this.faceVertexUvs[0][O];
            B(this, g.a, g.b, g.c, 0, 1, 2)
        }
        var J = ["a", "b", "c", "d"];
        for (O = 0, m = this.faces.length; O < m; O++) {
            g = this.faces[O];
            for (N = 0; N < Math.min(g.vertexNormals.length, 3); N++) {
                M.copy(g.vertexNormals[N]);
                C = g[J[N]];
                F = T[C];
                L.copy(F);
                L.sub(M.multiplyScalar(M.dot(F))).normalize();
                P.crossVectors(g.vertexNormals[N], F);
                b = P.dot(S[C]);
                D = (b < 0) ? -1 : 1;
                g.vertexTangents[N] = new THREE.Vector4(L.x, L.y, L.z, D)
            }
        }
        this.hasTangents = true
    },
    computeLineDistances: function() {
        var e = 0;
        var b = this.vertices;
        for (var c = 0, a = b.length; c < a; c++) {
            if (c > 0) {
                e += b[c].distanceTo(b[c - 1])
            }
            this.lineDistances[c] = e
        }
    },
    computeBoundingBox: function() {
        if (this.boundingBox === null) {
            this.boundingBox = new THREE.Box3()
        }
        this.boundingBox.setFromPoints(this.vertices)
    },
    computeBoundingSphere: function() {
        if (this.boundingSphere === null) {
            this.boundingSphere = new THREE.Sphere()
        }
        this.boundingSphere.setFromPoints(this.vertices)
    },
    merge: function(f, s, E) {
        if (f instanceof THREE.Geometry === false) {
            console.error("THREE.Geometry.merge(): geometry not an instance of THREE.Geometry.", f);
            return
        }
        var k, m = this.vertices.length,
            d = this.vertices,
            c = f.vertices,
            b = this.faces,
            a = f.faces,
            B = this.faceVertexUvs[0],
            A = f.faceVertexUvs[0];
        if (E === undefined) {
            E = 0
        }
        if (s !== undefined) {
            k = new THREE.Matrix3().getNormalMatrix(s)
        }
        for (var t = 0, l = c.length; t < l; t++) {
            var C = c[t];
            var p = C.clone();
            if (s !== undefined) {
                p.applyMatrix4(s)
            }
            d.push(p)
        }
        for (t = 0, l = a.length; t < l; t++) {
            var h = a[t],
                o, D, q, n = h.vertexNormals,
                v = h.vertexColors;
            o = new THREE.Face3(h.a + m, h.b + m, h.c + m);
            o.normal.copy(h.normal);
            if (k !== undefined) {
                o.normal.applyMatrix3(k).normalize()
            }
            for (var r = 0, u = n.length; r < u; r++) {
                D = n[r].clone();
                if (k !== undefined) {
                    D.applyMatrix3(k).normalize()
                }
                o.vertexNormals.push(D)
            }
            o.color.copy(h.color);
            for (var r = 0, u = v.length; r < u; r++) {
                q = v[r];
                o.vertexColors.push(q.clone())
            }
            o.materialIndex = h.materialIndex + E;
            b.push(o)
        }
        for (t = 0, l = A.length; t < l; t++) {
            var g = A[t],
                e = [];
            if (g === undefined) {
                continue
            }
            for (var r = 0, u = g.length; r < u; r++) {
                e.push(g[r].clone())
            }
            B.push(e)
        }
    },
    mergeMesh: function(a) {
        if (a instanceof THREE.Mesh === false) {
            console.error("THREE.Geometry.mergeMesh(): mesh not an instance of THREE.Mesh.", a);
            return
        }
        a.matrixAutoUpdate && a.updateMatrix();
        this.merge(a.geometry, a.matrix)
    },
    mergeVertices: function() {
        var b = {};
        var a = [],
            C = [];
        var f, D;
        var h = 4;
        var B = Math.pow(10, h);
        var t, e, d;
        var c, r, s, A, g;
        for (t = 0, e = this.vertices.length; t < e; t++) {
            f = this.vertices[t];
            D = Math.round(f.x * B) + "_" + Math.round(f.y * B) + "_" + Math.round(f.z * B);
            if (b[D] === undefined) {
                b[D] = t;
                a.push(this.vertices[t]);
                C[t] = a.length - 1
            } else {
                C[t] = C[b[D]]
            }
        }
        var o = [];
        for (t = 0, e = this.faces.length; t < e; t++) {
            d = this.faces[t];
            d.a = C[d.a];
            d.b = C[d.b];
            d.c = C[d.c];
            c = [d.a, d.b, d.c];
            var q = -1;
            for (var p = 0; p < 3; p++) {
                if (c[p] == c[(p + 1) % 3]) {
                    q = p;
                    o.push(t);
                    break
                }
            }
        }
        for (t = o.length - 1; t >= 0; t--) {
            var m = o[t];
            this.faces.splice(m, 1);
            for (s = 0, A = this.faceVertexUvs.length; s < A; s++) {
                this.faceVertexUvs[s].splice(m, 1)
            }
        }
        var l = this.vertices.length - a.length;
        this.vertices = a;
        return l
    },
    toJSON: function() {
        var h = {
            metadata: {
                version: 4,
                type: "BufferGeometry",
                generator: "BufferGeometryExporter"
            },
            uuid: this.uuid,
            type: this.type
        };
        if (this.name !== "") {
            h.name = this.name
        }
        if (this.parameters !== undefined) {
            var f = this.parameters;
            for (var H in f) {
                if (f[H] !== undefined) {
                    h[H] = f[H]
                }
            }
            return h
        }
        var e = [];
        for (var v = 0; v < this.vertices.length; v++) {
            var B = this.vertices[v];
            e.push(B.x, B.y, B.z)
        }
        var b = [];
        var q = [];
        var n = {};
        var j = [];
        var E = {};
        var k = [];
        var d = {};
        for (var v = 0; v < this.faces.length; v++) {
            var g = this.faces[v];
            var o = false;
            var D = false;
            var a = this.faceVertexUvs[0][v] !== undefined;
            var A = g.normal.length() > 0;
            var u = g.vertexNormals.length > 0;
            var s = g.color.r !== 1 || g.color.g !== 1 || g.color.b !== 1;
            var p = g.vertexColors.length > 0;
            var G = 0;
            G = m(G, 0, 0);
            G = m(G, 1, o);
            G = m(G, 2, D);
            G = m(G, 3, a);
            G = m(G, 4, A);
            G = m(G, 5, u);
            G = m(G, 6, s);
            G = m(G, 7, p);
            b.push(G);
            b.push(g.a, g.b, g.c);
            if (a) {
                var C = this.faceVertexUvs[0][v];
                b.push(c(C[0]), c(C[1]), c(C[2]))
            }
            if (A) {
                b.push(F(g.normal))
            }
            if (u) {
                var t = g.vertexNormals;
                b.push(F(t[0]), F(t[1]), F(t[2]))
            }
            if (s) {
                b.push(l(g.color))
            }
            if (p) {
                var r = g.vertexColors;
                b.push(l(r[0]), l(r[1]), l(r[2]))
            }
        }

        function m(J, i, I) {
            return I ? J | (1 << i) : J & (~(1 << i))
        }

        function F(I) {
            var i = I.x.toString() + I.y.toString() + I.z.toString();
            if (n[i] !== undefined) {
                return n[i]
            }
            n[i] = q.length / 3;
            q.push(I.x, I.y, I.z);
            return n[i]
        }

        function l(i) {
            var I = i.r.toString() + i.g.toString() + i.b.toString();
            if (E[I] !== undefined) {
                return E[I]
            }
            E[I] = j.length;
            j.push(i.getHex());
            return E[I]
        }

        function c(i) {
            var I = i.x.toString() + i.y.toString();
            if (d[I] !== undefined) {
                return d[I]
            }
            d[I] = k.length / 2;
            k.push(i.x, i.y);
            return d[I]
        }
        h.data = {};
        h.data.vertices = e;
        h.data.normals = q;
        if (j.length > 0) {
            h.data.colors = j
        }
        if (k.length > 0) {
            h.data.uvs = [k]
        }
        h.data.faces = b;
        return h
    },
    clone: function() {
        var n = new THREE.Geometry();
        var m = this.vertices;
        for (var g = 0, o = m.length; g < o; g++) {
            n.vertices.push(m[g].clone())
        }
        var c = this.faces;
        for (var g = 0, o = c.length; g < o; g++) {
            n.faces.push(c[g].clone())
        }
        for (var g = 0, o = this.faceVertexUvs.length; g < o; g++) {
            var l = this.faceVertexUvs[g];
            if (n.faceVertexUvs[g] === undefined) {
                n.faceVertexUvs[g] = []
            }
            for (var f = 0, h = l.length; f < h; f++) {
                var e = l[f],
                    p = [];
                for (var d = 0, a = e.length; d < a; d++) {
                    var b = e[d];
                    p.push(b.clone())
                }
                n.faceVertexUvs[g].push(p)
            }
        }
        return n
    },
    dispose: function() {
        this.dispatchEvent({
            type: "dispose"
        })
    }
};
THREE.EventDispatcher.prototype.apply(THREE.Geometry.prototype);
THREE.GeometryIdCount = 0;
THREE.Camera = function() {
    THREE.Object3D.call(this);
    this.type = "Camera";
    this.matrixWorldInverse = new THREE.Matrix4();
    this.projectionMatrix = new THREE.Matrix4()
};
THREE.Camera.prototype = Object.create(THREE.Object3D.prototype);
THREE.Camera.prototype.constructor = THREE.Camera;
THREE.Camera.prototype.getWorldDirection = function() {
    var a = new THREE.Quaternion();
    return function(c) {
        var b = c || new THREE.Vector3();
        this.getWorldQuaternion(a);
        return b.set(0, 0, -1).applyQuaternion(a)
    }
}();
THREE.Camera.prototype.lookAt = function() {
    var a = new THREE.Matrix4();
    return function(b) {
        a.lookAt(this.position, b, this.up);
        this.quaternion.setFromRotationMatrix(a)
    }
}();
THREE.Camera.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.Camera()
    }
    THREE.Object3D.prototype.clone.call(this, a);
    a.matrixWorldInverse.copy(this.matrixWorldInverse);
    a.projectionMatrix.copy(this.projectionMatrix);
    return a
};
THREE.CubeCamera = function(f, e, g) {
    THREE.Object3D.call(this);
    this.type = "CubeCamera";
    var d = 90,
        b = 1;
    var c = new THREE.PerspectiveCamera(d, b, f, e);
    c.up.set(0, -1, 0);
    c.lookAt(new THREE.Vector3(1, 0, 0));
    this.add(c);
    var j = new THREE.PerspectiveCamera(d, b, f, e);
    j.up.set(0, -1, 0);
    j.lookAt(new THREE.Vector3(-1, 0, 0));
    this.add(j);
    var a = new THREE.PerspectiveCamera(d, b, f, e);
    a.up.set(0, 0, 1);
    a.lookAt(new THREE.Vector3(0, 1, 0));
    this.add(a);
    var i = new THREE.PerspectiveCamera(d, b, f, e);
    i.up.set(0, 0, -1);
    i.lookAt(new THREE.Vector3(0, -1, 0));
    this.add(i);
    var k = new THREE.PerspectiveCamera(d, b, f, e);
    k.up.set(0, -1, 0);
    k.lookAt(new THREE.Vector3(0, 0, 1));
    this.add(k);
    var h = new THREE.PerspectiveCamera(d, b, f, e);
    h.up.set(0, -1, 0);
    h.lookAt(new THREE.Vector3(0, 0, -1));
    this.add(h);
    this.renderTarget = new THREE.WebGLRenderTargetCube(g, g, {
        format: THREE.RGBFormat,
        magFilter: THREE.LinearFilter,
        minFilter: THREE.LinearFilter
    });
    this.updateCubeMap = function(n, o) {
        var m = this.renderTarget;
        var l = m.generateMipmaps;
        m.generateMipmaps = false;
        m.activeCubeFace = 0;
        n.render(o, c, m);
        m.activeCubeFace = 1;
        n.render(o, j, m);
        m.activeCubeFace = 2;
        n.render(o, a, m);
        m.activeCubeFace = 3;
        n.render(o, i, m);
        m.activeCubeFace = 4;
        n.render(o, k, m);
        m.generateMipmaps = l;
        m.activeCubeFace = 5;
        n.render(o, h, m)
    }
};
THREE.CubeCamera.prototype = Object.create(THREE.Object3D.prototype);
THREE.CubeCamera.prototype.constructor = THREE.CubeCamera;
THREE.OrthographicCamera = function(f, c, e, b, d, a) {
    THREE.Camera.call(this);
    this.type = "OrthographicCamera";
    this.zoom = 1;
    this.left = f;
    this.right = c;
    this.top = e;
    this.bottom = b;
    this.near = (d !== undefined) ? d : 0.1;
    this.far = (a !== undefined) ? a : 2000;
    this.updateProjectionMatrix()
};
THREE.OrthographicCamera.prototype = Object.create(THREE.Camera.prototype);
THREE.OrthographicCamera.prototype.constructor = THREE.OrthographicCamera;
THREE.OrthographicCamera.prototype.updateProjectionMatrix = function() {
    var c = (this.right - this.left) / (2 * this.zoom);
    var b = (this.top - this.bottom) / (2 * this.zoom);
    var a = (this.right + this.left) / 2;
    var d = (this.top + this.bottom) / 2;
    this.projectionMatrix.makeOrthographic(a - c, a + c, d + b, d - b, this.near, this.far)
};
THREE.OrthographicCamera.prototype.clone = function() {
    var a = new THREE.OrthographicCamera();
    THREE.Camera.prototype.clone.call(this, a);
    a.zoom = this.zoom;
    a.left = this.left;
    a.right = this.right;
    a.top = this.top;
    a.bottom = this.bottom;
    a.near = this.near;
    a.far = this.far;
    a.projectionMatrix.copy(this.projectionMatrix);
    return a
};
THREE.PerspectiveCamera = function(c, b, d, a) {
    THREE.Camera.call(this);
    this.type = "PerspectiveCamera";
    this.zoom = 1;
    this.fov = c !== undefined ? c : 50;
    this.aspect = b !== undefined ? b : 1;
    this.near = d !== undefined ? d : 0.1;
    this.far = a !== undefined ? a : 2000;
    this.updateProjectionMatrix()
};
THREE.PerspectiveCamera.prototype = Object.create(THREE.Camera.prototype);
THREE.PerspectiveCamera.prototype.constructor = THREE.PerspectiveCamera;
THREE.PerspectiveCamera.prototype.setLens = function(b, a) {
    if (a === undefined) {
        a = 24
    }
    this.fov = 2 * THREE.Math.radToDeg(Math.atan(a / (b * 2)));
    this.updateProjectionMatrix()
};
THREE.PerspectiveCamera.prototype.setViewOffset = function(e, c, b, f, d, a) {
    this.fullWidth = e;
    this.fullHeight = c;
    this.x = b;
    this.y = f;
    this.width = d;
    this.height = a;
    this.updateProjectionMatrix()
};
THREE.PerspectiveCamera.prototype.updateProjectionMatrix = function() {
    var d = THREE.Math.radToDeg(2 * Math.atan(Math.tan(THREE.Math.degToRad(this.fov) * 0.5) / this.zoom));
    if (this.fullWidth) {
        var c = this.fullWidth / this.fullHeight;
        var h = Math.tan(THREE.Math.degToRad(d * 0.5)) * this.near;
        var b = -h;
        var g = c * b;
        var e = c * h;
        var f = Math.abs(e - g);
        var a = Math.abs(h - b);
        this.projectionMatrix.makeFrustum(g + this.x * f / this.fullWidth, g + (this.x + this.width) * f / this.fullWidth, h - (this.y + this.height) * a / this.fullHeight, h - this.y * a / this.fullHeight, this.near, this.far)
    } else {
        this.projectionMatrix.makePerspective(d, this.aspect, this.near, this.far)
    }
};
THREE.PerspectiveCamera.prototype.clone = function() {
    var a = new THREE.PerspectiveCamera();
    THREE.Camera.prototype.clone.call(this, a);
    a.zoom = this.zoom;
    a.fov = this.fov;
    a.aspect = this.aspect;
    a.near = this.near;
    a.far = this.far;
    a.projectionMatrix.copy(this.projectionMatrix);
    return a
};
THREE.Light = function(a) {
    THREE.Object3D.call(this);
    this.type = "Light";
    this.color = new THREE.Color(a)
};
THREE.Light.prototype = Object.create(THREE.Object3D.prototype);
THREE.Light.prototype.constructor = THREE.Light;
THREE.Light.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.Light()
    }
    THREE.Object3D.prototype.clone.call(this, a);
    a.color.copy(this.color);
    return a
};
THREE.AmbientLight = function(a) {
    THREE.Light.call(this, a);
    this.type = "AmbientLight"
};
THREE.AmbientLight.prototype = Object.create(THREE.Light.prototype);
THREE.AmbientLight.prototype.constructor = THREE.AmbientLight;
THREE.AmbientLight.prototype.clone = function() {
    var a = new THREE.AmbientLight();
    THREE.Light.prototype.clone.call(this, a);
    return a
};
THREE.AreaLight = function(b, a) {
    THREE.Light.call(this, b);
    this.type = "AreaLight";
    this.normal = new THREE.Vector3(0, -1, 0);
    this.right = new THREE.Vector3(1, 0, 0);
    this.intensity = (a !== undefined) ? a : 1;
    this.width = 1;
    this.height = 1;
    this.constantAttenuation = 1.5;
    this.linearAttenuation = 0.5;
    this.quadraticAttenuation = 0.1
};
THREE.AreaLight.prototype = Object.create(THREE.Light.prototype);
THREE.AreaLight.prototype.constructor = THREE.AreaLight;
THREE.DirectionalLight = function(b, a) {
    THREE.Light.call(this, b);
    this.type = "DirectionalLight";
    this.position.set(0, 1, 0);
    this.target = new THREE.Object3D();
    this.intensity = (a !== undefined) ? a : 1;
    this.castShadow = false;
    this.onlyShadow = false;
    this.shadowCameraNear = 50;
    this.shadowCameraFar = 5000;
    this.shadowCameraLeft = -500;
    this.shadowCameraRight = 500;
    this.shadowCameraTop = 500;
    this.shadowCameraBottom = -500;
    this.shadowCameraVisible = false;
    this.shadowBias = 0;
    this.shadowDarkness = 0.5;
    this.shadowMapWidth = 512;
    this.shadowMapHeight = 512;
    this.shadowCascade = false;
    this.shadowCascadeOffset = new THREE.Vector3(0, 0, -1000);
    this.shadowCascadeCount = 2;
    this.shadowCascadeBias = [0, 0, 0];
    this.shadowCascadeWidth = [512, 512, 512];
    this.shadowCascadeHeight = [512, 512, 512];
    this.shadowCascadeNearZ = [-1, 0.99, 0.998];
    this.shadowCascadeFarZ = [0.99, 0.998, 1];
    this.shadowCascadeArray = [];
    this.shadowMap = null;
    this.shadowMapSize = null;
    this.shadowCamera = null;
    this.shadowMatrix = null
};
THREE.DirectionalLight.prototype = Object.create(THREE.Light.prototype);
THREE.DirectionalLight.prototype.constructor = THREE.DirectionalLight;
THREE.DirectionalLight.prototype.clone = function() {
    var a = new THREE.DirectionalLight();
    THREE.Light.prototype.clone.call(this, a);
    a.target = this.target.clone();
    a.intensity = this.intensity;
    a.castShadow = this.castShadow;
    a.onlyShadow = this.onlyShadow;
    a.shadowCameraNear = this.shadowCameraNear;
    a.shadowCameraFar = this.shadowCameraFar;
    a.shadowCameraLeft = this.shadowCameraLeft;
    a.shadowCameraRight = this.shadowCameraRight;
    a.shadowCameraTop = this.shadowCameraTop;
    a.shadowCameraBottom = this.shadowCameraBottom;
    a.shadowCameraVisible = this.shadowCameraVisible;
    a.shadowBias = this.shadowBias;
    a.shadowDarkness = this.shadowDarkness;
    a.shadowMapWidth = this.shadowMapWidth;
    a.shadowMapHeight = this.shadowMapHeight;
    a.shadowCascade = this.shadowCascade;
    a.shadowCascadeOffset.copy(this.shadowCascadeOffset);
    a.shadowCascadeCount = this.shadowCascadeCount;
    a.shadowCascadeBias = this.shadowCascadeBias.slice(0);
    a.shadowCascadeWidth = this.shadowCascadeWidth.slice(0);
    a.shadowCascadeHeight = this.shadowCascadeHeight.slice(0);
    a.shadowCascadeNearZ = this.shadowCascadeNearZ.slice(0);
    a.shadowCascadeFarZ = this.shadowCascadeFarZ.slice(0);
    return a
};
THREE.HemisphereLight = function(b, c, a) {
    THREE.Light.call(this, b);
    this.type = "HemisphereLight";
    this.position.set(0, 100, 0);
    this.groundColor = new THREE.Color(c);
    this.intensity = (a !== undefined) ? a : 1
};
THREE.HemisphereLight.prototype = Object.create(THREE.Light.prototype);
THREE.HemisphereLight.prototype.constructor = THREE.HemisphereLight;
THREE.HemisphereLight.prototype.clone = function() {
    var a = new THREE.HemisphereLight();
    THREE.Light.prototype.clone.call(this, a);
    a.groundColor.copy(this.groundColor);
    a.intensity = this.intensity;
    return a
};
THREE.PointLight = function(b, a, c) {
    THREE.Light.call(this, b);
    this.type = "PointLight";
    this.intensity = (a !== undefined) ? a : 1;
    this.distance = (c !== undefined) ? c : 0
};
THREE.PointLight.prototype = Object.create(THREE.Light.prototype);
THREE.PointLight.prototype.constructor = THREE.PointLight;
THREE.PointLight.prototype.clone = function() {
    var a = new THREE.PointLight();
    THREE.Light.prototype.clone.call(this, a);
    a.intensity = this.intensity;
    a.distance = this.distance;
    return a
};
THREE.SpotLight = function(b, a, e, d, c) {
    THREE.Light.call(this, b);
    this.type = "SpotLight";
    this.position.set(0, 1, 0);
    this.target = new THREE.Object3D();
    this.intensity = (a !== undefined) ? a : 1;
    this.distance = (e !== undefined) ? e : 0;
    this.angle = (d !== undefined) ? d : Math.PI / 3;
    this.exponent = (c !== undefined) ? c : 10;
    this.castShadow = false;
    this.onlyShadow = false;
    this.shadowCameraNear = 50;
    this.shadowCameraFar = 5000;
    this.shadowCameraFov = 50;
    this.shadowCameraVisible = false;
    this.shadowBias = 0;
    this.shadowDarkness = 0.5;
    this.shadowMapWidth = 512;
    this.shadowMapHeight = 512;
    this.shadowMap = null;
    this.shadowMapSize = null;
    this.shadowCamera = null;
    this.shadowMatrix = null
};
THREE.SpotLight.prototype = Object.create(THREE.Light.prototype);
THREE.SpotLight.prototype.constructor = THREE.SpotLight;
THREE.SpotLight.prototype.clone = function() {
    var a = new THREE.SpotLight();
    THREE.Light.prototype.clone.call(this, a);
    a.target = this.target.clone();
    a.intensity = this.intensity;
    a.distance = this.distance;
    a.angle = this.angle;
    a.exponent = this.exponent;
    a.castShadow = this.castShadow;
    a.onlyShadow = this.onlyShadow;
    a.shadowCameraNear = this.shadowCameraNear;
    a.shadowCameraFar = this.shadowCameraFar;
    a.shadowCameraFov = this.shadowCameraFov;
    a.shadowCameraVisible = this.shadowCameraVisible;
    a.shadowBias = this.shadowBias;
    a.shadowDarkness = this.shadowDarkness;
    a.shadowMapWidth = this.shadowMapWidth;
    a.shadowMapHeight = this.shadowMapHeight;
    return a
};
THREE.Cache = function() {
    this.files = {}
};
THREE.Cache.prototype = {
    constructor: THREE.Cache,
    add: function(b, a) {
        this.files[b] = a
    },
    get: function(a) {
        return this.files[a]
    },
    remove: function(a) {
        delete this.files[a]
    },
    clear: function() {
        this.files = {}
    }
};
THREE.Loader = function(a) {
    this.showStatus = a;
    this.statusDomElement = a ? THREE.Loader.prototype.addStatusElement() : null;
    this.imageLoader = new THREE.ImageLoader();
    this.onLoadStart = function() {};
    this.onLoadProgress = function() {};
    this.onLoadComplete = function() {}
};
THREE.Loader.prototype = {
    constructor: THREE.Loader,
    crossOrigin: undefined,
    addStatusElement: function() {
        var a = document.createElement("div");
        a.style.position = "absolute";
        a.style.right = "0px";
        a.style.top = "0px";
        a.style.fontSize = "0.8em";
        a.style.textAlign = "left";
        a.style.background = "rgba(0,0,0,0.25)";
        a.style.color = "#fff";
        a.style.width = "120px";
        a.style.padding = "0.5em 0.5em 0.5em 0.5em";
        a.style.zIndex = 1000;
        a.innerHTML = "Loading ...";
        return a
    },
    updateProgress: function(a) {
        var b = "Loaded ";
        if (a.total) {
            b += (100 * a.loaded / a.total).toFixed(0) + "%"
        } else {
            b += (a.loaded / 1024).toFixed(2) + " KB"
        }
        this.statusDomElement.innerHTML = b
    },
    extractUrlBase: function(a) {
        var b = a.split("/");
        if (b.length === 1) {
            return "./"
        }
        b.pop();
        return b.join("/") + "/"
    },
    initMaterials: function(a, c) {
        var d = [];
        for (var b = 0; b < a.length; ++b) {
            d[b] = this.createMaterial(a[b], c)
        }
        return d
    },
    needsTangents: function(b) {
        for (var d = 0, c = b.length; d < c; d++) {
            var a = b[d];
            if (a instanceof THREE.ShaderMaterial) {
                return true
            }
        }
        return false
    },
    createMaterial: function(e, c) {
        var j = this;

        function a(m) {
            var k = Math.log(m) / Math.LN2;
            return Math.pow(2, Math.round(k))
        }

        function g(r, l, p, m, q, n, k) {
            var o = c + p;
            var s;
            var t = THREE.Loader.Handlers.get(o);
            if (t !== null) {
                s = t.load(o)
            } else {
                s = new THREE.Texture();
                t = j.imageLoader;
                t.crossOrigin = j.crossOrigin;
                t.load(o, function(D) {
                    if (THREE.Math.isPowerOfTwo(D.width) === false || THREE.Math.isPowerOfTwo(D.height) === false) {
                        var C = a(D.width);
                        var v = a(D.height);
                        var A = document.createElement("canvas");
                        A.width = C;
                        A.height = v;
                        var B = A.getContext("2d");
                        B.drawImage(D, 0, 0, C, v);
                        s.image = A
                    } else {
                        s.image = D
                    }
                    s.needsUpdate = true
                })
            }
            s.sourceFile = p;
            if (m) {
                s.repeat.set(m[0], m[1]);
                if (m[0] !== 1) {
                    s.wrapS = THREE.RepeatWrapping
                }
                if (m[1] !== 1) {
                    s.wrapT = THREE.RepeatWrapping
                }
            }
            if (q) {
                s.offset.set(q[0], q[1])
            }
            if (n) {
                var u = {
                    repeat: THREE.RepeatWrapping,
                    mirror: THREE.MirroredRepeatWrapping
                };
                if (u[n[0]] !== undefined) {
                    s.wrapS = u[n[0]]
                }
                if (u[n[1]] !== undefined) {
                    s.wrapT = u[n[1]]
                }
            }
            if (k) {
                s.anisotropy = k
            }
            r[l] = s
        }

        function b(k) {
            return (k[0] * 255 << 16) + (k[1] * 255 << 8) + k[2] * 255
        }
        var d = "MeshLambertMaterial";
        var i = {
            color: 15658734,
            opacity: 1,
            map: null,
            lightMap: null,
            normalMap: null,
            bumpMap: null,
            wireframe: false
        };
        if (e.shading) {
            var h = e.shading.toLowerCase();
            if (h === "phong") {
                d = "MeshPhongMaterial"
            } else {
                if (h === "basic") {
                    d = "MeshBasicMaterial"
                }
            }
        }
        if (e.blending !== undefined && THREE[e.blending] !== undefined) {
            i.blending = THREE[e.blending]
        }
        if (e.transparent !== undefined || e.opacity < 1) {
            i.transparent = e.transparent
        }
        if (e.depthTest !== undefined) {
            i.depthTest = e.depthTest
        }
        if (e.depthWrite !== undefined) {
            i.depthWrite = e.depthWrite
        }
        if (e.visible !== undefined) {
            i.visible = e.visible
        }
        if (e.flipSided !== undefined) {
            i.side = THREE.BackSide
        }
        if (e.doubleSided !== undefined) {
            i.side = THREE.DoubleSide
        }
        if (e.wireframe !== undefined) {
            i.wireframe = e.wireframe
        }
        if (e.vertexColors !== undefined) {
            if (e.vertexColors === "face") {
                i.vertexColors = THREE.FaceColors
            } else {
                if (e.vertexColors) {
                    i.vertexColors = THREE.VertexColors
                }
            }
        }
        if (e.colorDiffuse) {
            i.color = b(e.colorDiffuse)
        } else {
            if (e.DbgColor) {
                i.color = e.DbgColor
            }
        }
        if (e.colorSpecular) {
            i.specular = b(e.colorSpecular)
        }
        if (e.colorAmbient) {
            i.ambient = b(e.colorAmbient)
        }
        if (e.colorEmissive) {
            i.emissive = b(e.colorEmissive)
        }
        if (e.transparency) {
            i.opacity = e.transparency
        }
        if (e.specularCoef) {
            i.shininess = e.specularCoef
        }
        if (e.mapDiffuse && c) {
            g(i, "map", e.mapDiffuse, e.mapDiffuseRepeat, e.mapDiffuseOffset, e.mapDiffuseWrap, e.mapDiffuseAnisotropy)
        }
        if (e.mapLight && c) {
            g(i, "lightMap", e.mapLight, e.mapLightRepeat, e.mapLightOffset, e.mapLightWrap, e.mapLightAnisotropy)
        }
        if (e.mapBump && c) {
            g(i, "bumpMap", e.mapBump, e.mapBumpRepeat, e.mapBumpOffset, e.mapBumpWrap, e.mapBumpAnisotropy)
        }
        if (e.mapNormal && c) {
            g(i, "normalMap", e.mapNormal, e.mapNormalRepeat, e.mapNormalOffset, e.mapNormalWrap, e.mapNormalAnisotropy)
        }
        if (e.mapSpecular && c) {
            g(i, "specularMap", e.mapSpecular, e.mapSpecularRepeat, e.mapSpecularOffset, e.mapSpecularWrap, e.mapSpecularAnisotropy)
        }
        if (e.mapAlpha && c) {
            g(i, "alphaMap", e.mapAlpha, e.mapAlphaRepeat, e.mapAlphaOffset, e.mapAlphaWrap, e.mapAlphaAnisotropy)
        }
        if (e.mapBumpScale) {
            i.bumpScale = e.mapBumpScale
        }
        if (e.mapNormalFactor) {
            i.normalScale = new THREE.Vector2(e.mapNormalFactor, e.mapNormalFactor)
        }
        var f = new THREE[d](i);
        if (e.DbgName !== undefined) {
            f.name = e.DbgName
        }
        return f
    }
};
THREE.Loader.Handlers = {
    handlers: [],
    add: function(b, a) {
        this.handlers.push(b, a)
    },
    get: function(d) {
        for (var c = 0, b = this.handlers.length; c < b; c += 2) {
            var e = this.handlers[c];
            var a = this.handlers[c + 1];
            if (e.test(d)) {
                return a
            }
        }
        return null
    }
};
THREE.XHRLoader = function(a) {
    this.cache = new THREE.Cache();
    this.manager = (a !== undefined) ? a : THREE.DefaultLoadingManager
};
THREE.XHRLoader.prototype = {
    constructor: THREE.XHRLoader,
    load: function(a, d, g, f) {
        var c = this;
        var b = c.cache.get(a);
        if (b !== undefined) {
            if (d) {
                d(b)
            }
            return
        }
        var e = new XMLHttpRequest();
        e.open("GET", a, true);
        e.addEventListener("load", function(h) {
            c.cache.add(a, this.response);
            if (d) {
                d(this.response)
            }
            c.manager.itemEnd(a)
        }, false);
        if (g !== undefined) {
            e.addEventListener("progress", function(h) {
                g(h)
            }, false)
        }
        if (f !== undefined) {
            e.addEventListener("error", function(h) {
                f(h)
            }, false)
        }
        if (this.crossOrigin !== undefined) {
            e.crossOrigin = this.crossOrigin
        }
        if (this.responseType !== undefined) {
            e.responseType = this.responseType
        }
        e.send(null);
        c.manager.itemStart(a)
    },
    setResponseType: function(a) {
        this.responseType = a
    },
    setCrossOrigin: function(a) {
        this.crossOrigin = a
    }
};
THREE.ImageLoader = function(a) {
    this.cache = new THREE.Cache();
    this.manager = (a !== undefined) ? a : THREE.DefaultLoadingManager
};
THREE.ImageLoader.prototype = {
    constructor: THREE.ImageLoader,
    load: function(a, d, g, e) {
        var c = this;
        var b = c.cache.get(a);
        if (b !== undefined) {
            d(b);
            return
        }
        var f = document.createElement("img");
        if (d !== undefined) {
            f.addEventListener("load", function(h) {
                c.cache.add(a, this);
                d(this);
                c.manager.itemEnd(a)
            }, false)
        }
        if (g !== undefined) {
            f.addEventListener("progress", function(h) {
                g(h)
            }, false)
        }
        if (e !== undefined) {
            f.addEventListener("error", function(h) {
                e(h)
            }, false)
        }
        if (this.crossOrigin !== undefined) {
            f.crossOrigin = this.crossOrigin
        }
        f.src = a;
        c.manager.itemStart(a);
        return f
    },
    setCrossOrigin: function(a) {
        this.crossOrigin = a
    }
};
THREE.JSONLoader = function(a) {
    THREE.Loader.call(this, a);
    this.withCredentials = false
};
THREE.JSONLoader.prototype = Object.create(THREE.Loader.prototype);
THREE.JSONLoader.prototype.constructor = THREE.JSONLoader;
THREE.JSONLoader.prototype.load = function(a, d, c) {
    var b = this;
    c = c && (typeof c === "string") ? c : this.extractUrlBase(a);
    this.onLoadStart();
    this.loadAjaxJSON(this, a, d, c)
};
THREE.JSONLoader.prototype.loadAjaxJSON = function(b, a, g, e, d) {
    var f = new XMLHttpRequest();
    var c = 0;
    f.onreadystatechange = function() {
        if (f.readyState === f.DONE) {
            if (f.status === 200 || f.status === 0) {
                if (f.responseText) {
                    var i = JSON.parse(f.responseText);
                    if (i.metadata !== undefined && i.metadata.type === "scene") {
                        console.error('THREE.JSONLoader: "' + a + '" seems to be a Scene. Use THREE.SceneLoader instead.');
                        return
                    }
                    var h = b.parse(i, e);
                    g(h.geometry, h.materials)
                } else {
                    console.error('THREE.JSONLoader: "' + a + '" seems to be unreachable or the file is empty.')
                }
                b.onLoadComplete()
            } else {
                console.error("THREE.JSONLoader: Couldn't load \"" + a + '" (' + f.status + ")")
            }
        } else {
            if (f.readyState === f.LOADING) {
                if (d) {
                    if (c === 0) {
                        c = f.getResponseHeader("Content-Length")
                    }
                    d({
                        total: c,
                        loaded: f.responseText.length
                    })
                }
            } else {
                if (f.readyState === f.HEADERS_RECEIVED) {
                    if (d !== undefined) {
                        c = f.getResponseHeader("Content-Length")
                    }
                }
            }
        }
    };
    f.open("GET", a, true);
    f.withCredentials = this.withCredentials;
    f.send(null)
};
THREE.JSONLoader.prototype.parse = function(i, c) {
    var h = this,
        e = new THREE.Geometry(),
        d = (i.scale !== undefined) ? 1 / i.scale : 1;
    a(d);
    f();
    b(d);
    e.computeFaceNormals();
    e.computeBoundingSphere();

    function a(X) {
        function B(u, j) {
            return u & (1 << j)
        }
        var S, R, H, s, r, q, V, K, D, o, I, L, k, U, Q, O, M, T, E, n, m, P, C, W, p, A, J, G, l = i.faces,
            t = i.vertices,
            N = i.normals,
            F = i.colors,
            Y = 0;
        if (i.uvs !== undefined) {
            for (S = 0; S < i.uvs.length; S++) {
                if (i.uvs[S].length) {
                    Y++
                }
            }
            for (S = 0; S < Y; S++) {
                e.faceVertexUvs[S] = []
            }
        }
        s = 0;
        r = t.length;
        while (s < r) {
            T = new THREE.Vector3();
            T.x = t[s++] * X;
            T.y = t[s++] * X;
            T.z = t[s++] * X;
            e.vertices.push(T)
        }
        s = 0;
        r = l.length;
        while (s < r) {
            o = l[s++];
            I = B(o, 0);
            L = B(o, 1);
            k = B(o, 3);
            U = B(o, 4);
            Q = B(o, 5);
            O = B(o, 6);
            M = B(o, 7);
            if (I) {
                n = new THREE.Face3();
                n.a = l[s];
                n.b = l[s + 1];
                n.c = l[s + 3];
                m = new THREE.Face3();
                m.a = l[s + 1];
                m.b = l[s + 2];
                m.c = l[s + 3];
                s += 4;
                if (L) {
                    D = l[s++];
                    n.materialIndex = D;
                    m.materialIndex = D
                }
                H = e.faces.length;
                if (k) {
                    for (S = 0; S < Y; S++) {
                        p = i.uvs[S];
                        e.faceVertexUvs[S][H] = [];
                        e.faceVertexUvs[S][H + 1] = [];
                        for (R = 0; R < 4; R++) {
                            K = l[s++];
                            J = p[K * 2];
                            G = p[K * 2 + 1];
                            A = new THREE.Vector2(J, G);
                            if (R !== 2) {
                                e.faceVertexUvs[S][H].push(A)
                            }
                            if (R !== 0) {
                                e.faceVertexUvs[S][H + 1].push(A)
                            }
                        }
                    }
                }
                if (U) {
                    V = l[s++] * 3;
                    n.normal.set(N[V++], N[V++], N[V]);
                    m.normal.copy(n.normal)
                }
                if (Q) {
                    for (S = 0; S < 4; S++) {
                        V = l[s++] * 3;
                        W = new THREE.Vector3(N[V++], N[V++], N[V]);
                        if (S !== 2) {
                            n.vertexNormals.push(W)
                        }
                        if (S !== 0) {
                            m.vertexNormals.push(W)
                        }
                    }
                }
                if (O) {
                    q = l[s++];
                    C = F[q];
                    n.color.setHex(C);
                    m.color.setHex(C)
                }
                if (M) {
                    for (S = 0; S < 4; S++) {
                        q = l[s++];
                        C = F[q];
                        if (S !== 2) {
                            n.vertexColors.push(new THREE.Color(C))
                        }
                        if (S !== 0) {
                            m.vertexColors.push(new THREE.Color(C))
                        }
                    }
                }
                e.faces.push(n);
                e.faces.push(m)
            } else {
                E = new THREE.Face3();
                E.a = l[s++];
                E.b = l[s++];
                E.c = l[s++];
                if (L) {
                    D = l[s++];
                    E.materialIndex = D
                }
                H = e.faces.length;
                if (k) {
                    for (S = 0; S < Y; S++) {
                        p = i.uvs[S];
                        e.faceVertexUvs[S][H] = [];
                        for (R = 0; R < 3; R++) {
                            K = l[s++];
                            J = p[K * 2];
                            G = p[K * 2 + 1];
                            A = new THREE.Vector2(J, G);
                            e.faceVertexUvs[S][H].push(A)
                        }
                    }
                }
                if (U) {
                    V = l[s++] * 3;
                    E.normal.set(N[V++], N[V++], N[V])
                }
                if (Q) {
                    for (S = 0; S < 3; S++) {
                        V = l[s++] * 3;
                        W = new THREE.Vector3(N[V++], N[V++], N[V]);
                        E.vertexNormals.push(W)
                    }
                }
                if (O) {
                    q = l[s++];
                    E.color.setHex(F[q])
                }
                if (M) {
                    for (S = 0; S < 3; S++) {
                        q = l[s++];
                        E.vertexColors.push(new THREE.Color(F[q]))
                    }
                }
                e.faces.push(E)
            }
        }
    }

    function f() {
        var j = (i.influencesPerVertex !== undefined) ? i.influencesPerVertex : 2;
        if (i.skinWeights) {
            for (var m = 0, k = i.skinWeights.length; m < k; m += j) {
                var t = i.skinWeights[m];
                var r = (j > 1) ? i.skinWeights[m + 1] : 0;
                var p = (j > 2) ? i.skinWeights[m + 2] : 0;
                var u = (j > 3) ? i.skinWeights[m + 3] : 0;
                e.skinWeights.push(new THREE.Vector4(t, r, p, u))
            }
        }
        if (i.skinIndices) {
            for (var m = 0, k = i.skinIndices.length; m < k; m += j) {
                var s = i.skinIndices[m];
                var q = (j > 1) ? i.skinIndices[m + 1] : 0;
                var o = (j > 2) ? i.skinIndices[m + 2] : 0;
                var n = (j > 3) ? i.skinIndices[m + 3] : 0;
                e.skinIndices.push(new THREE.Vector4(s, q, o, n))
            }
        }
        e.bones = i.bones;
        if (e.bones && e.bones.length > 0 && (e.skinWeights.length !== e.skinIndices.length || e.skinIndices.length !== e.vertices.length)) {
            console.warn("When skinning, number of vertices (" + e.vertices.length + "), skinIndices (" + e.skinIndices.length + "), and skinWeights (" + e.skinWeights.length + ") should match.")
        }
        e.animation = i.animation;
        e.animations = i.animations
    }

    function b(m) {
        if (i.morphTargets !== undefined) {
            var p, n, A, k, r, B;
            for (p = 0, n = i.morphTargets.length; p < n; p++) {
                e.morphTargets[p] = {};
                e.morphTargets[p].name = i.morphTargets[p].name;
                e.morphTargets[p].vertices = [];
                r = e.morphTargets[p].vertices;
                B = i.morphTargets[p].vertices;
                for (A = 0, k = B.length; A < k; A += 3) {
                    var q = new THREE.Vector3();
                    q.x = B[A] * m;
                    q.y = B[A + 1] * m;
                    q.z = B[A + 2] * m;
                    r.push(q)
                }
            }
        }
        if (i.morphColors !== undefined) {
            var p, n, s, u, t, j, o;
            for (p = 0, n = i.morphColors.length; p < n; p++) {
                e.morphColors[p] = {};
                e.morphColors[p].name = i.morphColors[p].name;
                e.morphColors[p].colors = [];
                t = e.morphColors[p].colors;
                j = i.morphColors[p].colors;
                for (s = 0, u = j.length; s < u; s += 3) {
                    o = new THREE.Color(16755200);
                    o.setRGB(j[s], j[s + 1], j[s + 2]);
                    t.push(o)
                }
            }
        }
    }
    if (i.materials === undefined || i.materials.length === 0) {
        return {
            geometry: e
        }
    } else {
        var g = this.initMaterials(i.materials, c);
        if (this.needsTangents(g)) {
            e.computeTangents()
        }
        return {
            geometry: e,
            materials: g
        }
    }
};
THREE.LoadingManager = function(c, f, e) {
    var b = this;
    var a = 0,
        d = 0;
    this.onLoad = c;
    this.onProgress = f;
    this.onError = e;
    this.itemStart = function(g) {
        d++
    };
    this.itemEnd = function(g) {
        a++;
        if (b.onProgress !== undefined) {
            b.onProgress(g, a, d)
        }
        if (a === d && b.onLoad !== undefined) {
            b.onLoad()
        }
    }
};
THREE.DefaultLoadingManager = new THREE.LoadingManager();
THREE.BufferGeometryLoader = function(a) {
    this.manager = (a !== undefined) ? a : THREE.DefaultLoadingManager
};
THREE.BufferGeometryLoader.prototype = {
    constructor: THREE.BufferGeometryLoader,
    load: function(b, d, f, e) {
        var c = this;
        var a = new THREE.XHRLoader(c.manager);
        a.setCrossOrigin(this.crossOrigin);
        a.load(b, function(g) {
            d(c.parse(JSON.parse(g)))
        }, f, e)
    },
    setCrossOrigin: function(a) {
        this.crossOrigin = a
    },
    parse: function(i) {
        var e = new THREE.BufferGeometry();
        var d = i.attributes;
        for (var h in d) {
            var b = d[h];
            var f = new self[b.type](b.array);
            e.addAttribute(h, new THREE.BufferAttribute(f, b.itemSize))
        }
        var c = i.offsets;
        if (c !== undefined) {
            e.offsets = JSON.parse(JSON.stringify(c))
        }
        var g = i.boundingSphere;
        if (g !== undefined) {
            var a = new THREE.Vector3();
            if (g.center !== undefined) {
                a.fromArray(g.center)
            }
            e.boundingSphere = new THREE.Sphere(a, g.radius)
        }
        return e
    }
};
THREE.MaterialLoader = function(a) {
    this.manager = (a !== undefined) ? a : THREE.DefaultLoadingManager
};
THREE.MaterialLoader.prototype = {
    constructor: THREE.MaterialLoader,
    load: function(b, d, f, e) {
        var c = this;
        var a = new THREE.XHRLoader(c.manager);
        a.setCrossOrigin(this.crossOrigin);
        a.load(b, function(g) {
            d(c.parse(JSON.parse(g)))
        }, f, e)
    },
    setCrossOrigin: function(a) {
        this.crossOrigin = a
    },
    parse: function(c) {
        var d = new THREE[c.type];
        if (c.color !== undefined) {
            d.color.setHex(c.color)
        }
        if (c.ambient !== undefined) {
            d.ambient.setHex(c.ambient)
        }
        if (c.emissive !== undefined) {
            d.emissive.setHex(c.emissive)
        }
        if (c.specular !== undefined) {
            d.specular.setHex(c.specular)
        }
        if (c.shininess !== undefined) {
            d.shininess = c.shininess
        }
        if (c.uniforms !== undefined) {
            d.uniforms = c.uniforms
        }
        if (c.vertexShader !== undefined) {
            d.vertexShader = c.vertexShader
        }
        if (c.fragmentShader !== undefined) {
            d.fragmentShader = c.fragmentShader
        }
        if (c.vertexColors !== undefined) {
            d.vertexColors = c.vertexColors
        }
        if (c.shading !== undefined) {
            d.shading = c.shading
        }
        if (c.blending !== undefined) {
            d.blending = c.blending
        }
        if (c.side !== undefined) {
            d.side = c.side
        }
        if (c.opacity !== undefined) {
            d.opacity = c.opacity
        }
        if (c.transparent !== undefined) {
            d.transparent = c.transparent
        }
        if (c.wireframe !== undefined) {
            d.wireframe = c.wireframe
        }
        if (c.materials !== undefined) {
            for (var b = 0, a = c.materials.length; b < a; b++) {
                d.materials.push(this.parse(c.materials[b]))
            }
        }
        return d
    }
};
THREE.ObjectLoader = function(a) {
    this.manager = (a !== undefined) ? a : THREE.DefaultLoadingManager
};
THREE.ObjectLoader.prototype = {
    constructor: THREE.ObjectLoader,
    load: function(b, d, f, e) {
        var c = this;
        var a = new THREE.XHRLoader(c.manager);
        a.setCrossOrigin(this.crossOrigin);
        a.load(b, function(g) {
            d(c.parse(JSON.parse(g)))
        }, f, e)
    },
    setCrossOrigin: function(a) {
        this.crossOrigin = a
    },
    parse: function(c) {
        var d = this.parseGeometries(c.geometries);
        var a = this.parseMaterials(c.materials);
        var b = this.parseObject(c.object, d, a);
        return b
    },
    parseGeometries: function(d) {
        var e = {};
        if (d !== undefined) {
            var b = new THREE.JSONLoader();
            var g = new THREE.BufferGeometryLoader();
            for (var c = 0, a = d.length; c < a; c++) {
                var h;
                var f = d[c];
                switch (f.type) {
                    case "PlaneGeometry":
                        h = new THREE.PlaneGeometry(f.width, f.height, f.widthSegments, f.heightSegments);
                        break;
                    case "BoxGeometry":
                    case "CubeGeometry":
                        h = new THREE.BoxGeometry(f.width, f.height, f.depth, f.widthSegments, f.heightSegments, f.depthSegments);
                        break;
                    case "CircleGeometry":
                        h = new THREE.CircleGeometry(f.radius, f.segments);
                        break;
                    case "CylinderGeometry":
                        h = new THREE.CylinderGeometry(f.radiusTop, f.radiusBottom, f.height, f.radialSegments, f.heightSegments, f.openEnded);
                        break;
                    case "SphereGeometry":
                        h = new THREE.SphereGeometry(f.radius, f.widthSegments, f.heightSegments, f.phiStart, f.phiLength, f.thetaStart, f.thetaLength);
                        break;
                    case "IcosahedronGeometry":
                        h = new THREE.IcosahedronGeometry(f.radius, f.detail);
                        break;
                    case "TorusGeometry":
                        h = new THREE.TorusGeometry(f.radius, f.tube, f.radialSegments, f.tubularSegments, f.arc);
                        break;
                    case "TorusKnotGeometry":
                        h = new THREE.TorusKnotGeometry(f.radius, f.tube, f.radialSegments, f.tubularSegments, f.p, f.q, f.heightScale);
                        break;
                    case "BufferGeometry":
                        h = g.parse(f.data);
                        break;
                    case "Geometry":
                        h = b.parse(f.data).geometry;
                        break
                }
                h.uuid = f.uuid;
                if (f.name !== undefined) {
                    h.name = f.name
                }
                e[f.uuid] = h
            }
        }
        return e
    },
    parseMaterials: function(e) {
        var c = {};
        if (e !== undefined) {
            var a = new THREE.MaterialLoader();
            for (var d = 0, b = e.length; d < b; d++) {
                var g = e[d];
                var f = a.parse(g);
                f.uuid = g.uuid;
                if (g.name !== undefined) {
                    f.name = g.name
                }
                c[g.uuid] = f
            }
        }
        return c
    },
    parseObject: function() {
        var a = new THREE.Matrix4();
        return function(f, e, b) {
            var c;
            switch (f.type) {
                case "Scene":
                    c = new THREE.Scene();
                    break;
                case "PerspectiveCamera":
                    c = new THREE.PerspectiveCamera(f.fov, f.aspect, f.near, f.far);
                    break;
                case "OrthographicCamera":
                    c = new THREE.OrthographicCamera(f.left, f.right, f.top, f.bottom, f.near, f.far);
                    break;
                case "AmbientLight":
                    c = new THREE.AmbientLight(f.color);
                    break;
                case "DirectionalLight":
                    c = new THREE.DirectionalLight(f.color, f.intensity);
                    break;
                case "PointLight":
                    c = new THREE.PointLight(f.color, f.intensity, f.distance);
                    break;
                case "SpotLight":
                    c = new THREE.SpotLight(f.color, f.intensity, f.distance, f.angle, f.exponent);
                    break;
                case "HemisphereLight":
                    c = new THREE.HemisphereLight(f.color, f.groundColor, f.intensity);
                    break;
                case "Mesh":
                    var g = e[f.geometry];
                    var d = b[f.material];
                    if (g === undefined) {
                        console.warn("THREE.ObjectLoader: Undefined geometry", f.geometry)
                    }
                    if (d === undefined) {
                        console.warn("THREE.ObjectLoader: Undefined material", f.material)
                    }
                    c = new THREE.Mesh(g, d);
                    break;
                case "Line":
                    var g = e[f.geometry];
                    var d = b[f.material];
                    if (g === undefined) {
                        console.warn("THREE.ObjectLoader: Undefined geometry", f.geometry)
                    }
                    if (d === undefined) {
                        console.warn("THREE.ObjectLoader: Undefined material", f.material)
                    }
                    c = new THREE.Line(g, d);
                    break;
                case "Sprite":
                    var d = b[f.material];
                    if (d === undefined) {
                        console.warn("THREE.ObjectLoader: Undefined material", f.material)
                    }
                    c = new THREE.Sprite(d);
                    break;
                case "Group":
                    c = new THREE.Group();
                    break;
                default:
                    c = new THREE.Object3D()
            }
            c.uuid = f.uuid;
            if (f.name !== undefined) {
                c.name = f.name
            }
            if (f.matrix !== undefined) {
                a.fromArray(f.matrix);
                a.decompose(c.position, c.quaternion, c.scale)
            } else {
                if (f.position !== undefined) {
                    c.position.fromArray(f.position)
                }
                if (f.rotation !== undefined) {
                    c.rotation.fromArray(f.rotation)
                }
                if (f.scale !== undefined) {
                    c.scale.fromArray(f.scale)
                }
            }
            if (f.visible !== undefined) {
                c.visible = f.visible
            }
            if (f.userData !== undefined) {
                c.userData = f.userData
            }
            if (f.children !== undefined) {
                for (var h in f.children) {
                    c.add(this.parseObject(f.children[h], e, b))
                }
            }
            return c
        }
    }()
};
THREE.TextureLoader = function(a) {
    this.manager = (a !== undefined) ? a : THREE.DefaultLoadingManager
};
THREE.TextureLoader.prototype = {
    constructor: THREE.TextureLoader,
    load: function(b, d, f, e) {
        var c = this;
        var a = new THREE.ImageLoader(c.manager);
        a.setCrossOrigin(this.crossOrigin);
        a.load(b, function(h) {
            var g = new THREE.Texture(h);
            g.needsUpdate = true;
            if (d !== undefined) {
                d(g)
            }
        }, f, e)
    },
    setCrossOrigin: function(a) {
        this.crossOrigin = a
    }
};
THREE.DataTextureLoader = THREE.BinaryTextureLoader = function() {
    this._parser = null
};
THREE.BinaryTextureLoader.prototype = {
    constructor: THREE.BinaryTextureLoader,
    load: function(b, d, g, f) {
        var c = this;
        var e = new THREE.DataTexture();
        var a = new THREE.XHRLoader();
        a.setResponseType("arraybuffer");
        a.load(b, function(h) {
            var i = c._parser(h);
            if (!i) {
                return
            }
            if (undefined !== i.image) {
                e.image = i.image
            } else {
                if (undefined !== i.data) {
                    e.image.width = i.width;
                    e.image.height = i.height;
                    e.image.data = i.data
                }
            }
            e.wrapS = undefined !== i.wrapS ? i.wrapS : THREE.ClampToEdgeWrapping;
            e.wrapT = undefined !== i.wrapT ? i.wrapT : THREE.ClampToEdgeWrapping;
            e.magFilter = undefined !== i.magFilter ? i.magFilter : THREE.LinearFilter;
            e.minFilter = undefined !== i.minFilter ? i.minFilter : THREE.LinearMipMapLinearFilter;
            e.anisotropy = undefined !== i.anisotropy ? i.anisotropy : 1;
            if (undefined !== i.format) {
                e.format = i.format
            }
            if (undefined !== i.type) {
                e.type = i.type
            }
            if (undefined !== i.mipmaps) {
                e.mipmaps = i.mipmaps
            }
            if (1 === i.mipmapCount) {
                e.minFilter = THREE.LinearFilter
            }
            e.needsUpdate = true;
            if (d) {
                d(e, i)
            }
        }, g, f);
        return e
    }
};
THREE.CompressedTextureLoader = function() {
    this._parser = null
};
THREE.CompressedTextureLoader.prototype = {
    constructor: THREE.CompressedTextureLoader,
    load: function(a, g, d) {
        var l = this;
        var h = [];
        var e = new THREE.CompressedTexture();
        e.image = h;
        var k = new THREE.XHRLoader();
        k.setResponseType("arraybuffer");
        if (a instanceof Array) {
            var c = 0;
            var f = function(m) {
                k.load(a[m], function(i) {
                    var n = l._parser(i, true);
                    h[m] = {
                        width: n.width,
                        height: n.height,
                        format: n.format,
                        mipmaps: n.mipmaps
                    };
                    c += 1;
                    if (c === 6) {
                        if (n.mipmapCount == 1) {
                            e.minFilter = THREE.LinearFilter
                        }
                        e.format = n.format;
                        e.needsUpdate = true;
                        if (g) {
                            g(e)
                        }
                    }
                })
            };
            for (var b = 0, j = a.length; b < j;
                ++b) {
                f(b)
            }
        } else {
            k.load(a, function(n) {
                var q = l._parser(n, true);
                if (q.isCubemap) {
                    var m = q.mipmaps.length / q.mipmapCount;
                    for (var p = 0; p < m; p++) {
                        h[p] = {
                            mipmaps: []
                        };
                        for (var o = 0; o < q.mipmapCount; o++) {
                            h[p].mipmaps.push(q.mipmaps[p * q.mipmapCount + o]);
                            h[p].format = q.format;
                            h[p].width = q.width;
                            h[p].height = q.height
                        }
                    }
                } else {
                    e.image.width = q.width;
                    e.image.height = q.height;
                    e.mipmaps = q.mipmaps
                }
                if (q.mipmapCount === 1) {
                    e.minFilter = THREE.LinearFilter
                }
                e.format = q.format;
                e.needsUpdate = true;
                if (g) {
                    g(e)
                }
            })
        }
        return e
    }
};
THREE.Material = function() {
    Object.defineProperty(this, "id", {
        value: THREE.MaterialIdCount++
    });
    this.uuid = THREE.Math.generateUUID();
    this.name = "";
    this.type = "Material";
    this.side = THREE.FrontSide;
    this.opacity = 1;
    this.transparent = false;
    this.blending = THREE.NormalBlending;
    this.blendSrc = THREE.SrcAlphaFactor;
    this.blendDst = THREE.OneMinusSrcAlphaFactor;
    this.blendEquation = THREE.AddEquation;
    this.depthTest = true;
    this.depthWrite = true;
    this.polygonOffset = false;
    this.polygonOffsetFactor = 0;
    this.polygonOffsetUnits = 0;
    this.alphaTest = 0;
    this.overdraw = 0;
    this.visible = true;
    this.needsUpdate = true
};
THREE.Material.prototype = {
    constructor: THREE.Material,
    setValues: function(a) {
        if (a === undefined) {
            return
        }
        for (var b in a) {
            var d = a[b];
            if (d === undefined) {
                console.warn("THREE.Material: '" + b + "' parameter is undefined.");
                continue
            }
            if (b in this) {
                var c = this[b];
                if (c instanceof THREE.Color) {
                    c.set(d)
                } else {
                    if (c instanceof THREE.Vector3 && d instanceof THREE.Vector3) {
                        c.copy(d)
                    } else {
                        if (b == "overdraw") {
                            this[b] = Number(d)
                        } else {
                            this[b] = d
                        }
                    }
                }
            }
        }
    },
    toJSON: function() {
        var a = {
            metadata: {
                version: 4.2,
                type: "material",
                generator: "MaterialExporter"
            },
            uuid: this.uuid,
            type: this.type
        };
        if (this.name !== "") {
            a.name = this.name
        }
        if (this instanceof THREE.MeshBasicMaterial) {
            a.color = this.color.getHex();
            if (this.vertexColors !== THREE.NoColors) {
                a.vertexColors = this.vertexColors
            }
            if (this.blending !== THREE.NormalBlending) {
                a.blending = this.blending
            }
            if (this.side !== THREE.FrontSide) {
                a.side = this.side
            }
        } else {
            if (this instanceof THREE.MeshLambertMaterial) {
                a.color = this.color.getHex();
                a.ambient = this.ambient.getHex();
                a.emissive = this.emissive.getHex();
                if (this.vertexColors !== THREE.NoColors) {
                    a.vertexColors = this.vertexColors
                }
                if (this.blending !== THREE.NormalBlending) {
                    a.blending = this.blending
                }
                if (this.side !== THREE.FrontSide) {
                    a.side = this.side
                }
            } else {
                if (this instanceof THREE.MeshPhongMaterial) {
                    a.color = this.color.getHex();
                    a.ambient = this.ambient.getHex();
                    a.emissive = this.emissive.getHex();
                    a.specular = this.specular.getHex();
                    a.shininess = this.shininess;
                    if (this.vertexColors !== THREE.NoColors) {
                        a.vertexColors = this.vertexColors
                    }
                    if (this.blending !== THREE.NormalBlending) {
                        a.blending = this.blending
                    }
                    if (this.side !== THREE.FrontSide) {
                        a.side = this.side
                    }
                } else {
                    if (this instanceof THREE.MeshNormalMaterial) {
                        if (this.shading !== THREE.FlatShading) {
                            a.shading = this.shading
                        }
                        if (this.blending !== THREE.NormalBlending) {
                            a.blending = this.blending
                        }
                        if (this.side !== THREE.FrontSide) {
                            a.side = this.side
                        }
                    } else {
                        if (this instanceof THREE.MeshDepthMaterial) {
                            if (this.blending !== THREE.NormalBlending) {
                                a.blending = this.blending
                            }
                            if (this.side !== THREE.FrontSide) {
                                a.side = this.side
                            }
                        } else {
                            if (this instanceof THREE.ShaderMaterial) {
                                a.uniforms = this.uniforms;
                                a.vertexShader = this.vertexShader;
                                a.fragmentShader = this.fragmentShader
                            } else {
                                if (this instanceof THREE.SpriteMaterial) {
                                    a.color = this.color.getHex()
                                }
                            }
                        }
                    }
                }
            }
        }
        if (this.opacity < 1) {
            a.opacity = this.opacity
        }
        if (this.transparent !== false) {
            a.transparent = this.transparent
        }
        if (this.wireframe !== false) {
            a.wireframe = this.wireframe
        }
        return a
    },
    clone: function(a) {
        if (a === undefined) {
            a = new THREE.Material()
        }
        a.name = this.name;
        a.side = this.side;
        a.opacity = this.opacity;
        a.transparent = this.transparent;
        a.blending = this.blending;
        a.blendSrc = this.blendSrc;
        a.blendDst = this.blendDst;
        a.blendEquation = this.blendEquation;
        a.depthTest = this.depthTest;
        a.depthWrite = this.depthWrite;
        a.polygonOffset = this.polygonOffset;
        a.polygonOffsetFactor = this.polygonOffsetFactor;
        a.polygonOffsetUnits = this.polygonOffsetUnits;
        a.alphaTest = this.alphaTest;
        a.overdraw = this.overdraw;
        a.visible = this.visible;
        return a
    },
    dispose: function() {
        this.dispatchEvent({
            type: "dispose"
        })
    }
};
THREE.EventDispatcher.prototype.apply(THREE.Material.prototype);
THREE.MaterialIdCount = 0;
THREE.LineBasicMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "LineBasicMaterial";
    this.color = new THREE.Color(16777215);
    this.linewidth = 1;
    this.linecap = "round";
    this.linejoin = "round";
    this.vertexColors = THREE.NoColors;
    this.fog = true;
    this.setValues(a)
};
THREE.LineBasicMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.LineBasicMaterial.prototype.constructor = THREE.LineBasicMaterial;
THREE.LineBasicMaterial.prototype.clone = function() {
    var a = new THREE.LineBasicMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.color.copy(this.color);
    a.linewidth = this.linewidth;
    a.linecap = this.linecap;
    a.linejoin = this.linejoin;
    a.vertexColors = this.vertexColors;
    a.fog = this.fog;
    return a
};
THREE.LineDashedMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "LineDashedMaterial";
    this.color = new THREE.Color(16777215);
    this.linewidth = 1;
    this.scale = 1;
    this.dashSize = 3;
    this.gapSize = 1;
    this.vertexColors = false;
    this.fog = true;
    this.setValues(a)
};
THREE.LineDashedMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.LineDashedMaterial.prototype.constructor = THREE.LineDashedMaterial;
THREE.LineDashedMaterial.prototype.clone = function() {
    var a = new THREE.LineDashedMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.color.copy(this.color);
    a.linewidth = this.linewidth;
    a.scale = this.scale;
    a.dashSize = this.dashSize;
    a.gapSize = this.gapSize;
    a.vertexColors = this.vertexColors;
    a.fog = this.fog;
    return a
};
THREE.MeshBasicMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "MeshBasicMaterial";
    this.color = new THREE.Color(16777215);
    this.map = null;
    this.lightMap = null;
    this.specularMap = null;
    this.alphaMap = null;
    this.envMap = null;
    this.combine = THREE.MultiplyOperation;
    this.reflectivity = 1;
    this.refractionRatio = 0.98;
    this.fog = true;
    this.shading = THREE.SmoothShading;
    this.wireframe = false;
    this.wireframeLinewidth = 1;
    this.wireframeLinecap = "round";
    this.wireframeLinejoin = "round";
    this.vertexColors = THREE.NoColors;
    this.skinning = false;
    this.morphTargets = false;
    this.setValues(a)
};
THREE.MeshBasicMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.MeshBasicMaterial.prototype.constructor = THREE.MeshBasicMaterial;
THREE.MeshBasicMaterial.prototype.clone = function() {
    var a = new THREE.MeshBasicMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.color.copy(this.color);
    a.map = this.map;
    a.lightMap = this.lightMap;
    a.specularMap = this.specularMap;
    a.alphaMap = this.alphaMap;
    a.envMap = this.envMap;
    a.combine = this.combine;
    a.reflectivity = this.reflectivity;
    a.refractionRatio = this.refractionRatio;
    a.fog = this.fog;
    a.shading = this.shading;
    a.wireframe = this.wireframe;
    a.wireframeLinewidth = this.wireframeLinewidth;
    a.wireframeLinecap = this.wireframeLinecap;
    a.wireframeLinejoin = this.wireframeLinejoin;
    a.vertexColors = this.vertexColors;
    a.skinning = this.skinning;
    a.morphTargets = this.morphTargets;
    return a
};
THREE.MeshLambertMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "MeshLambertMaterial";
    this.color = new THREE.Color(16777215);
    this.ambient = new THREE.Color(16777215);
    this.emissive = new THREE.Color(0);
    this.wrapAround = false;
    this.wrapRGB = new THREE.Vector3(1, 1, 1);
    this.map = null;
    this.lightMap = null;
    this.specularMap = null;
    this.alphaMap = null;
    this.envMap = null;
    this.combine = THREE.MultiplyOperation;
    this.reflectivity = 1;
    this.refractionRatio = 0.98;
    this.fog = true;
    this.shading = THREE.SmoothShading;
    this.wireframe = false;
    this.wireframeLinewidth = 1;
    this.wireframeLinecap = "round";
    this.wireframeLinejoin = "round";
    this.vertexColors = THREE.NoColors;
    this.skinning = false;
    this.morphTargets = false;
    this.morphNormals = false;
    this.setValues(a)
};
THREE.MeshLambertMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.MeshLambertMaterial.prototype.constructor = THREE.MeshLambertMaterial;
THREE.MeshLambertMaterial.prototype.clone = function() {
    var a = new THREE.MeshLambertMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.color.copy(this.color);
    a.ambient.copy(this.ambient);
    a.emissive.copy(this.emissive);
    a.wrapAround = this.wrapAround;
    a.wrapRGB.copy(this.wrapRGB);
    a.map = this.map;
    a.lightMap = this.lightMap;
    a.specularMap = this.specularMap;
    a.alphaMap = this.alphaMap;
    a.envMap = this.envMap;
    a.combine = this.combine;
    a.reflectivity = this.reflectivity;
    a.refractionRatio = this.refractionRatio;
    a.fog = this.fog;
    a.shading = this.shading;
    a.wireframe = this.wireframe;
    a.wireframeLinewidth = this.wireframeLinewidth;
    a.wireframeLinecap = this.wireframeLinecap;
    a.wireframeLinejoin = this.wireframeLinejoin;
    a.vertexColors = this.vertexColors;
    a.skinning = this.skinning;
    a.morphTargets = this.morphTargets;
    a.morphNormals = this.morphNormals;
    return a
};
THREE.MeshPhongMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "MeshPhongMaterial";
    this.color = new THREE.Color(16777215);
    this.ambient = new THREE.Color(16777215);
    this.emissive = new THREE.Color(0);
    this.specular = new THREE.Color(1118481);
    this.shininess = 30;
    this.metal = false;
    this.wrapAround = false;
    this.wrapRGB = new THREE.Vector3(1, 1, 1);
    this.map = null;
    this.lightMap = null;
    this.bumpMap = null;
    this.bumpScale = 1;
    this.normalMap = null;
    this.normalScale = new THREE.Vector2(1, 1);
    this.specularMap = null;
    this.alphaMap = null;
    this.envMap = null;
    this.combine = THREE.MultiplyOperation;
    this.reflectivity = 1;
    this.refractionRatio = 0.98;
    this.fog = true;
    this.shading = THREE.SmoothShading;
    this.wireframe = false;
    this.wireframeLinewidth = 1;
    this.wireframeLinecap = "round";
    this.wireframeLinejoin = "round";
    this.vertexColors = THREE.NoColors;
    this.skinning = false;
    this.morphTargets = false;
    this.morphNormals = false;
    this.setValues(a)
};
THREE.MeshPhongMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.MeshPhongMaterial.prototype.constructor = THREE.MeshPhongMaterial;
THREE.MeshPhongMaterial.prototype.clone = function() {
    var a = new THREE.MeshPhongMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.color.copy(this.color);
    a.ambient.copy(this.ambient);
    a.emissive.copy(this.emissive);
    a.specular.copy(this.specular);
    a.shininess = this.shininess;
    a.metal = this.metal;
    a.wrapAround = this.wrapAround;
    a.wrapRGB.copy(this.wrapRGB);
    a.map = this.map;
    a.lightMap = this.lightMap;
    a.bumpMap = this.bumpMap;
    a.bumpScale = this.bumpScale;
    a.normalMap = this.normalMap;
    a.normalScale.copy(this.normalScale);
    a.specularMap = this.specularMap;
    a.alphaMap = this.alphaMap;
    a.envMap = this.envMap;
    a.combine = this.combine;
    a.reflectivity = this.reflectivity;
    a.refractionRatio = this.refractionRatio;
    a.fog = this.fog;
    a.shading = this.shading;
    a.wireframe = this.wireframe;
    a.wireframeLinewidth = this.wireframeLinewidth;
    a.wireframeLinecap = this.wireframeLinecap;
    a.wireframeLinejoin = this.wireframeLinejoin;
    a.vertexColors = this.vertexColors;
    a.skinning = this.skinning;
    a.morphTargets = this.morphTargets;
    a.morphNormals = this.morphNormals;
    return a
};
THREE.MeshDepthMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "MeshDepthMaterial";
    this.morphTargets = false;
    this.wireframe = false;
    this.wireframeLinewidth = 1;
    this.setValues(a)
};
THREE.MeshDepthMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.MeshDepthMaterial.prototype.constructor = THREE.MeshDepthMaterial;
THREE.MeshDepthMaterial.prototype.clone = function() {
    var a = new THREE.MeshDepthMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.wireframe = this.wireframe;
    a.wireframeLinewidth = this.wireframeLinewidth;
    return a
};
THREE.MeshNormalMaterial = function(a) {
    THREE.Material.call(this, a);
    this.type = "MeshNormalMaterial";
    this.shading = THREE.FlatShading;
    this.wireframe = false;
    this.wireframeLinewidth = 1;
    this.morphTargets = false;
    this.setValues(a)
};
THREE.MeshNormalMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.MeshNormalMaterial.prototype.constructor = THREE.MeshNormalMaterial;
THREE.MeshNormalMaterial.prototype.clone = function() {
    var a = new THREE.MeshNormalMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.shading = this.shading;
    a.wireframe = this.wireframe;
    a.wireframeLinewidth = this.wireframeLinewidth;
    return a
};
THREE.MeshFaceMaterial = function(a) {
    this.uuid = THREE.Math.generateUUID();
    this.type = "MeshFaceMaterial";
    this.materials = a instanceof Array ? a : []
};
THREE.MeshFaceMaterial.prototype = {
    constructor: THREE.MeshFaceMaterial,
    toJSON: function() {
        var b = {
            metadata: {
                version: 4.2,
                type: "material",
                generator: "MaterialExporter"
            },
            uuid: this.uuid,
            type: this.type,
            materials: []
        };
        for (var c = 0, a = this.materials.length; c < a; c++) {
            b.materials.push(this.materials[c].toJSON())
        }
        return b
    },
    clone: function() {
        var b = new THREE.MeshFaceMaterial();
        for (var a = 0; a < this.materials.length; a++) {
            b.materials.push(this.materials[a].clone())
        }
        return b
    }
};
THREE.PointCloudMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "PointCloudMaterial";
    this.color = new THREE.Color(16777215);
    this.map = null;
    this.size = 1;
    this.sizeAttenuation = true;
    this.vertexColors = THREE.NoColors;
    this.fog = true;
    this.setValues(a)
};
THREE.PointCloudMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.PointCloudMaterial.prototype.constructor = THREE.PointCloudMaterial;
THREE.PointCloudMaterial.prototype.clone = function() {
    var a = new THREE.PointCloudMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.color.copy(this.color);
    a.map = this.map;
    a.size = this.size;
    a.sizeAttenuation = this.sizeAttenuation;
    a.vertexColors = this.vertexColors;
    a.fog = this.fog;
    return a
};
THREE.ParticleBasicMaterial = function(a) {
    console.warn("THREE.ParticleBasicMaterial has been renamed to THREE.PointCloudMaterial.");
    return new THREE.PointCloudMaterial(a)
};
THREE.ParticleSystemMaterial = function(a) {
    console.warn("THREE.ParticleSystemMaterial has been renamed to THREE.PointCloudMaterial.");
    return new THREE.PointCloudMaterial(a)
};
THREE.ShaderMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "ShaderMaterial";
    this.defines = {};
    this.uniforms = {};
    this.attributes = null;
    this.vertexShader = "void main() {\n\tgl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );\n}";
    this.fragmentShader = "void main() {\n\tgl_FragColor = vec4( 1.0, 0.0, 0.0, 1.0 );\n}";
    this.shading = THREE.SmoothShading;
    this.linewidth = 1;
    this.wireframe = false;
    this.wireframeLinewidth = 1;
    this.fog = false;
    this.lights = false;
    this.vertexColors = THREE.NoColors;
    this.skinning = false;
    this.morphTargets = false;
    this.morphNormals = false;
    this.defaultAttributeValues = {
        color: [1, 1, 1],
        uv: [0, 0],
        uv2: [0, 0]
    };
    this.index0AttributeName = undefined;
    this.setValues(a)
};
THREE.ShaderMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.ShaderMaterial.prototype.constructor = THREE.ShaderMaterial;
THREE.ShaderMaterial.prototype.clone = function() {
    var a = new THREE.ShaderMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.fragmentShader = this.fragmentShader;
    a.vertexShader = this.vertexShader;
    a.uniforms = THREE.UniformsUtils.clone(this.uniforms);
    a.attributes = this.attributes;
    a.defines = this.defines;
    a.shading = this.shading;
    a.wireframe = this.wireframe;
    a.wireframeLinewidth = this.wireframeLinewidth;
    a.fog = this.fog;
    a.lights = this.lights;
    a.vertexColors = this.vertexColors;
    a.skinning = this.skinning;
    a.morphTargets = this.morphTargets;
    a.morphNormals = this.morphNormals;
    return a
};
THREE.RawShaderMaterial = function(a) {
    THREE.ShaderMaterial.call(this, a);
    this.type = "RawShaderMaterial"
};
THREE.RawShaderMaterial.prototype = Object.create(THREE.ShaderMaterial.prototype);
THREE.RawShaderMaterial.prototype.constructor = THREE.RawShaderMaterial;
THREE.RawShaderMaterial.prototype.clone = function() {
    var a = new THREE.RawShaderMaterial();
    THREE.ShaderMaterial.prototype.clone.call(this, a);
    return a
};
THREE.SpriteMaterial = function(a) {
    THREE.Material.call(this);
    this.type = "SpriteMaterial";
    this.color = new THREE.Color(16777215);
    this.map = null;
    this.rotation = 0;
    this.fog = false;
    this.setValues(a)
};
THREE.SpriteMaterial.prototype = Object.create(THREE.Material.prototype);
THREE.SpriteMaterial.prototype.constructor = THREE.SpriteMaterial;
THREE.SpriteMaterial.prototype.clone = function() {
    var a = new THREE.SpriteMaterial();
    THREE.Material.prototype.clone.call(this, a);
    a.color.copy(this.color);
    a.map = this.map;
    a.rotation = this.rotation;
    a.fog = this.fog;
    return a
};
THREE.Texture = function(d, b, f, e, i, c, h, g, a) {
    Object.defineProperty(this, "id", {
        value: THREE.TextureIdCount++
    });
    this.uuid = THREE.Math.generateUUID();
    this.name = "";
    this.image = d !== undefined ? d : THREE.Texture.DEFAULT_IMAGE;
    this.mipmaps = [];
    this.mapping = b !== undefined ? b : THREE.Texture.DEFAULT_MAPPING;
    this.wrapS = f !== undefined ? f : THREE.ClampToEdgeWrapping;
    this.wrapT = e !== undefined ? e : THREE.ClampToEdgeWrapping;
    this.magFilter = i !== undefined ? i : THREE.LinearFilter;
    this.minFilter = c !== undefined ? c : THREE.LinearMipMapLinearFilter;
    this.anisotropy = a !== undefined ? a : 1;
    this.format = h !== undefined ? h : THREE.RGBAFormat;
    this.type = g !== undefined ? g : THREE.UnsignedByteType;
    this.offset = new THREE.Vector2(0, 0);
    this.repeat = new THREE.Vector2(1, 1);
    this.generateMipmaps = true;
    this.premultiplyAlpha = false;
    this.flipY = true;
    this.unpackAlignment = 4;
    this._needsUpdate = false;
    this.onUpdate = null
};
THREE.Texture.DEFAULT_IMAGE = undefined;
THREE.Texture.DEFAULT_MAPPING = THREE.UVMapping;
THREE.Texture.prototype = {
    constructor: THREE.Texture,
    get needsUpdate() {
        return this._needsUpdate
    },
    set needsUpdate(a) {
        if (a === true) {
            this.update()
        }
        this._needsUpdate = a
    },
    clone: function(a) {
        if (a === undefined) {
            a = new THREE.Texture()
        }
        a.image = this.image;
        a.mipmaps = this.mipmaps.slice(0);
        a.mapping = this.mapping;
        a.wrapS = this.wrapS;
        a.wrapT = this.wrapT;
        a.magFilter = this.magFilter;
        a.minFilter = this.minFilter;
        a.anisotropy = this.anisotropy;
        a.format = this.format;
        a.type = this.type;
        a.offset.copy(this.offset);
        a.repeat.copy(this.repeat);
        a.generateMipmaps = this.generateMipmaps;
        a.premultiplyAlpha = this.premultiplyAlpha;
        a.flipY = this.flipY;
        a.unpackAlignment = this.unpackAlignment;
        return a
    },
    update: function() {
        this.dispatchEvent({
            type: "update"
        })
    },
    dispose: function() {
        this.dispatchEvent({
            type: "dispose"
        })
    }
};
THREE.EventDispatcher.prototype.apply(THREE.Texture.prototype);
THREE.TextureIdCount = 0;
THREE.CubeTexture = function(g, b, e, d, i, c, h, f, a) {
    b = b !== undefined ? b : THREE.CubeReflectionMapping;
    THREE.Texture.call(this, g, b, e, d, i, c, h, f, a);
    this.images = g
};
THREE.CubeTexture.prototype = Object.create(THREE.Texture.prototype);
THREE.CubeTexture.prototype.constructor = THREE.CubeTexture;
THREE.CubeTexture.clone = function(a) {
    if (a === undefined) {
        a = new THREE.CubeTexture()
    }
    THREE.Texture.prototype.clone.call(this, a);
    a.images = this.images;
    return a
};
THREE.CompressedTexture = function(e, d, k, i, h, b, g, f, j, c, a) {
    THREE.Texture.call(this, null, b, g, f, j, c, i, h, a);
    this.image = {
        width: d,
        height: k
    };
    this.mipmaps = e;
    this.flipY = false;
    this.generateMipmaps = false
};
THREE.CompressedTexture.prototype = Object.create(THREE.Texture.prototype);
THREE.CompressedTexture.prototype.constructor = THREE.CompressedTexture;
THREE.CompressedTexture.prototype.clone = function() {
    var a = new THREE.CompressedTexture();
    THREE.Texture.prototype.clone.call(this, a);
    return a
};
THREE.DataTexture = function(f, d, k, i, h, b, g, e, j, c, a) {
    THREE.Texture.call(this, null, b, g, e, j, c, i, h, a);
    this.image = {
        data: f,
        width: d,
        height: k
    }
};
THREE.DataTexture.prototype = Object.create(THREE.Texture.prototype);
THREE.DataTexture.prototype.constructor = THREE.DataTexture;
THREE.DataTexture.prototype.clone = function() {
    var a = new THREE.DataTexture();
    THREE.Texture.prototype.clone.call(this, a);
    return a
};
THREE.VideoTexture = function(c, b, g, f, j, d, i, h, a) {
    THREE.Texture.call(this, c, b, g, f, j, d, i, h, a);
    this.generateMipmaps = false;
    var k = this;
    var e = function() {
        requestAnimationFrame(e);
        if (c.readyState === c.HAVE_ENOUGH_DATA) {
            k.needsUpdate = true
        }
    };
    e()
};
THREE.VideoTexture.prototype = Object.create(THREE.Texture.prototype);
THREE.VideoTexture.prototype.constructor = THREE.VideoTexture;
THREE.Group = function() {
    THREE.Object3D.call(this);
    this.type = "Group"
};
THREE.Group.prototype = Object.create(THREE.Object3D.prototype);
THREE.Group.prototype.constructor = THREE.Group;
THREE.PointCloud = function(b, a) {
    THREE.Object3D.call(this);
    this.type = "PointCloud";
    this.geometry = b !== undefined ? b : new THREE.Geometry();
    this.material = a !== undefined ? a : new THREE.PointCloudMaterial({
        color: Math.random() * 16777215
    })
};
THREE.PointCloud.prototype = Object.create(THREE.Object3D.prototype);
THREE.PointCloud.prototype.constructor = THREE.PointCloud;
THREE.PointCloud.prototype.raycast = (function() {
    var b = new THREE.Matrix4();
    var a = new THREE.Ray();
    return function(u, c) {
        var D = this;
        var g = D.geometry;
        var e = u.params.PointCloud.threshold;
        b.getInverse(this.matrixWorld);
        a.copy(u.ray).applyMatrix4(b);
        if (g.boundingBox !== null) {
            if (a.isIntersectionBox(g.boundingBox) === false) {
                return
            }
        }
        var d = e / ((this.scale.x + this.scale.y + this.scale.z) / 3);
        var C = new THREE.Vector3();
        var s = function(i, F) {
            var H = a.distanceToPoint(i);
            if (H < d) {
                var E = a.closestPointToPoint(i);
                E.applyMatrix4(D.matrixWorld);
                var G = u.ray.origin.distanceTo(E);
                c.push({
                    distance: G,
                    distanceToRay: H,
                    point: E.clone(),
                    index: F,
                    face: null,
                    object: D
                })
            }
        };
        if (g instanceof THREE.BufferGeometry) {
            var p = g.attributes;
            var o = p.position.array;
            if (p.index !== undefined) {
                var h = p.index.array;
                var k = g.offsets;
                if (k.length === 0) {
                    var j = {
                        start: 0,
                        count: h.length,
                        index: 0
                    };
                    k = [j]
                }
                for (var t = 0, r = k.length; t < r; ++t) {
                    var f = k[t].start;
                    var n = k[t].count;
                    var m = k[t].index;
                    for (var v = f, q = f + n; v < q; v++) {
                        var B = m + h[v];
                        C.fromArray(o, B * 3);
                        s(C, B)
                    }
                }
            } else {
                var A = o.length / 3;
                for (var v = 0; v < A; v++) {
                    C.set(o[3 * v], o[3 * v + 1], o[3 * v + 2]);
                    s(C, v)
                }
            }
        } else {
            var l = this.geometry.vertices;
            for (var v = 0; v < l.length; v++) {
                s(l[v], v)
            }
        }
    }
}());
THREE.PointCloud.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.PointCloud(this.geometry, this.material)
    }
    THREE.Object3D.prototype.clone.call(this, a);
    return a
};
THREE.ParticleSystem = function(b, a) {
    console.warn("THREE.ParticleSystem has been renamed to THREE.PointCloud.");
    return new THREE.PointCloud(b, a)
};
THREE.Line = function(c, a, b) {
    THREE.Object3D.call(this);
    this.type = "Line";
    this.geometry = c !== undefined ? c : new THREE.Geometry();
    this.material = a !== undefined ? a : new THREE.LineBasicMaterial({
        color: Math.random() * 16777215
    });
    this.mode = (b !== undefined) ? b : THREE.LineStrip
};
THREE.LineStrip = 0;
THREE.LinePieces = 1;
THREE.Line.prototype = Object.create(THREE.Object3D.prototype);
THREE.Line.prototype.constructor = THREE.Line;
THREE.Line.prototype.raycast = (function() {
    var c = new THREE.Matrix4();
    var a = new THREE.Ray();
    var b = new THREE.Sphere();
    return function(u, e) {
        var B = u.linePrecision;
        var F = B * B;
        var j = this.geometry;
        if (j.boundingSphere === null) {
            j.computeBoundingSphere()
        }
        b.copy(j.boundingSphere);
        b.applyMatrix4(this.matrixWorld);
        if (u.ray.isIntersectionSphere(b) === false) {
            return
        }
        c.getInverse(this.matrixWorld);
        a.copy(u.ray).applyMatrix4(c);
        var G = new THREE.Vector3();
        var d = new THREE.Vector3();
        var k = new THREE.Vector3();
        var v = new THREE.Vector3();
        var o = this.mode === THREE.LineStrip ? 1 : 2;
        if (j instanceof THREE.BufferGeometry) {
            var s = j.attributes;
            if (s.index !== undefined) {
                var l = s.index.array;
                var r = s.position.array;
                var m = j.offsets;
                if (m.length === 0) {
                    m = [{
                        start: 0,
                        count: l.length,
                        index: 0
                    }]
                }
                for (var t = 0; t < m.length; t++) {
                    var h = m[t].start;
                    var q = m[t].count;
                    var p = m[t].index;
                    for (var A = h; A < h + q - 1; A += o) {
                        var D = p + l[A];
                        var C = p + l[A + 1];
                        G.fromArray(r, D * 3);
                        d.fromArray(r, C * 3);
                        var f = a.distanceSqToSegment(G, d, v, k);
                        if (f > F) {
                            continue
                        }
                        var g = a.origin.distanceTo(v);
                        if (g < u.near || g > u.far) {
                            continue
                        }
                        e.push({
                            distance: g,
                            point: k.clone().applyMatrix4(this.matrixWorld),
                            face: null,
                            faceIndex: null,
                            object: this
                        })
                    }
                }
            } else {
                var r = s.position.array;
                for (var A = 0; A < r.length / 3 - 1; A += o) {
                    G.fromArray(r, 3 * A);
                    d.fromArray(r, 3 * A + 3);
                    var f = a.distanceSqToSegment(G, d, v, k);
                    if (f > F) {
                        continue
                    }
                    var g = a.origin.distanceTo(v);
                    if (g < u.near || g > u.far) {
                        continue
                    }
                    e.push({
                        distance: g,
                        point: k.clone().applyMatrix4(this.matrixWorld),
                        face: null,
                        faceIndex: null,
                        object: this
                    })
                }
            }
        } else {
            if (j instanceof THREE.Geometry) {
                var n = j.vertices;
                var E = n.length;
                for (var A = 0; A < E - 1; A += o) {
                    var f = a.distanceSqToSegment(n[A], n[A + 1], v, k);
                    if (f > F) {
                        continue
                    }
                    var g = a.origin.distanceTo(v);
                    if (g < u.near || g > u.far) {
                        continue
                    }
                    e.push({
                        distance: g,
                        point: k.clone().applyMatrix4(this.matrixWorld),
                        face: null,
                        faceIndex: null,
                        object: this
                    })
                }
            }
        }
    }
}());
THREE.Line.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.Line(this.geometry, this.material, this.mode)
    }
    THREE.Object3D.prototype.clone.call(this, a);
    return a
};
THREE.Mesh = function(b, a) {
    THREE.Object3D.call(this);
    this.type = "Mesh";
    this.geometry = b !== undefined ? b : new THREE.Geometry();
    this.material = a !== undefined ? a : new THREE.MeshBasicMaterial({
        color: Math.random() * 16777215
    });
    this.updateMorphTargets()
};
THREE.Mesh.prototype = Object.create(THREE.Object3D.prototype);
THREE.Mesh.prototype.constructor = THREE.Mesh;
THREE.Mesh.prototype.updateMorphTargets = function() {
    if (this.geometry.morphTargets !== undefined && this.geometry.morphTargets.length > 0) {
        this.morphTargetBase = -1;
        this.morphTargetForcedOrder = [];
        this.morphTargetInfluences = [];
        this.morphTargetDictionary = {};
        for (var a = 0, b = this.geometry.morphTargets.length; a < b; a++) {
            this.morphTargetInfluences.push(0);
            this.morphTargetDictionary[this.geometry.morphTargets[a].name] = a
        }
    }
};
THREE.Mesh.prototype.getMorphTargetIndexByName = function(a) {
    if (this.morphTargetDictionary[a] !== undefined) {
        return this.morphTargetDictionary[a]
    }
    return 0
};
THREE.Mesh.prototype.raycast = (function() {
    var f = new THREE.Matrix4();
    var a = new THREE.Ray();
    var b = new THREE.Sphere();
    var e = new THREE.Vector3();
    var d = new THREE.Vector3();
    var c = new THREE.Vector3();
    return function(J, g) {
        var n = this.geometry;
        if (n.boundingSphere === null) {
            n.computeBoundingSphere()
        }
        b.copy(n.boundingSphere);
        b.applyMatrix4(this.matrixWorld);
        if (J.ray.isIntersectionSphere(b) === false) {
            return
        }
        f.getInverse(this.matrixWorld);
        a.copy(J.ray).applyMatrix4(f);
        if (n.boundingBox !== null) {
            if (a.isIntersectionBox(n.boundingBox) === false) {
                return
            }
        }
        if (n instanceof THREE.BufferGeometry) {
            var F = this.material;
            if (F === undefined) {
                return
            }
            var v = n.attributes;
            var V, T, S;
            var P = J.precision;
            if (v.index !== undefined) {
                var o = v.index.array;
                var u = v.position.array;
                var p = n.offsets;
                if (p.length === 0) {
                    p = [{
                        start: 0,
                        count: o.length,
                        index: 0
                    }]
                }
                for (var I = 0, E = p.length; I < E; ++I) {
                    var m = p[I].start;
                    var r = p[I].count;
                    var s = p[I].index;
                    for (var O = m, D = m + r; O < D; O += 3) {
                        V = s + o[O];
                        T = s + o[O + 1];
                        S = s + o[O + 2];
                        e.fromArray(u, V * 3);
                        d.fromArray(u, T * 3);
                        c.fromArray(u, S * 3);
                        if (F.side === THREE.BackSide) {
                            var N = a.intersectTriangle(c, d, e, true)
                        } else {
                            var N = a.intersectTriangle(e, d, c, F.side !== THREE.DoubleSide)
                        }
                        if (N === null) {
                            continue
                        }
                        N.applyMatrix4(this.matrixWorld);
                        var l = J.ray.origin.distanceTo(N);
                        if (l < P || l < J.near || l > J.far) {
                            continue
                        }
                        g.push({
                            distance: l,
                            point: N,
                            face: new THREE.Face3(V, T, S, THREE.Triangle.normal(e, d, c)),
                            faceIndex: null,
                            object: this
                        })
                    }
                }
            } else {
                var u = v.position.array;
                for (var O = 0, M = 0, D = u.length; O < D; O += 3, M += 9) {
                    V = O;
                    T = O + 1;
                    S = O + 2;
                    e.fromArray(u, M);
                    d.fromArray(u, M + 3);
                    c.fromArray(u, M + 6);
                    if (F.side === THREE.BackSide) {
                        var N = a.intersectTriangle(c, d, e, true)
                    } else {
                        var N = a.intersectTriangle(e, d, c, F.side !== THREE.DoubleSide)
                    }
                    if (N === null) {
                        continue
                    }
                    N.applyMatrix4(this.matrixWorld);
                    var l = J.ray.origin.distanceTo(N);
                    if (l < P || l < J.near || l > J.far) {
                        continue
                    }
                    g.push({
                        distance: l,
                        point: N,
                        face: new THREE.Face3(V, T, S, THREE.Triangle.normal(e, d, c)),
                        faceIndex: null,
                        object: this
                    })
                }
            }
        } else {
            if (n instanceof THREE.Geometry) {
                var h = this.material instanceof THREE.MeshFaceMaterial;
                var K = h === true ? this.material.materials : null;
                var V, T, S, R;
                var P = J.precision;
                var q = n.vertices;
                for (var Q = 0, B = n.faces.length; Q < B; Q++) {
                    var A = n.faces[Q];
                    var F = h === true ? K[A.materialIndex] : this.material;
                    if (F === undefined) {
                        continue
                    }
                    V = q[A.a];
                    T = q[A.b];
                    S = q[A.c];
                    if (F.morphTargets === true) {
                        var C = n.morphTargets;
                        var H = this.morphTargetInfluences;
                        e.set(0, 0, 0);
                        d.set(0, 0, 0);
                        c.set(0, 0, 0);
                        for (var G = 0, k = C.length; G < k; G++) {
                            var L = H[G];
                            if (L === 0) {
                                continue
                            }
                            var U = C[G].vertices;
                            e.x += (U[A.a].x - V.x) * L;
                            e.y += (U[A.a].y - V.y) * L;
                            e.z += (U[A.a].z - V.z) * L;
                            d.x += (U[A.b].x - T.x) * L;
                            d.y += (U[A.b].y - T.y) * L;
                            d.z += (U[A.b].z - T.z) * L;
                            c.x += (U[A.c].x - S.x) * L;
                            c.y += (U[A.c].y - S.y) * L;
                            c.z += (U[A.c].z - S.z) * L
                        }
                        e.add(V);
                        d.add(T);
                        c.add(S);
                        V = e;
                        T = d;
                        S = c
                    }
                    if (F.side === THREE.BackSide) {
                        var N = a.intersectTriangle(S, T, V, true)
                    } else {
                        var N = a.intersectTriangle(V, T, S, F.side !== THREE.DoubleSide)
                    }
                    if (N === null) {
                        continue
                    }
                    N.applyMatrix4(this.matrixWorld);
                    var l = J.ray.origin.distanceTo(N);
                    if (l < P || l < J.near || l > J.far) {
                        continue
                    }
                    g.push({
                        distance: l,
                        point: N,
                        face: A,
                        faceIndex: Q,
                        object: this
                    })
                }
            }
        }
    }
}());
THREE.Mesh.prototype.clone = function(b, a) {
    if (b === undefined) {
        b = new THREE.Mesh(this.geometry, this.material)
    }
    THREE.Object3D.prototype.clone.call(this, b, a);
    return b
};
THREE.Bone = function(a) {
    THREE.Object3D.call(this);
    this.skin = a
};
THREE.Bone.prototype = Object.create(THREE.Object3D.prototype);
THREE.Bone.prototype.constructor = THREE.Bone;
THREE.Skeleton = function(c, e, f) {
    this.useVertexTexture = f !== undefined ? f : true;
    this.identityMatrix = new THREE.Matrix4();
    c = c || [];
    this.bones = c.slice(0);
    if (this.useVertexTexture) {
        var d;
        if (this.bones.length > 256) {
            d = 64
        } else {
            if (this.bones.length > 64) {
                d = 32
            } else {
                if (this.bones.length > 16) {
                    d = 16
                } else {
                    d = 8
                }
            }
        }
        this.boneTextureWidth = d;
        this.boneTextureHeight = d;
        this.boneMatrices = new Float32Array(this.boneTextureWidth * this.boneTextureHeight * 4);
        this.boneTexture = new THREE.DataTexture(this.boneMatrices, this.boneTextureWidth, this.boneTextureHeight, THREE.RGBAFormat, THREE.FloatType);
        this.boneTexture.minFilter = THREE.NearestFilter;
        this.boneTexture.magFilter = THREE.NearestFilter;
        this.boneTexture.generateMipmaps = false;
        this.boneTexture.flipY = false
    } else {
        this.boneMatrices = new Float32Array(16 * this.bones.length)
    }
    if (e === undefined) {
        this.calculateInverses()
    } else {
        if (this.bones.length === e.length) {
            this.boneInverses = e.slice(0)
        } else {
            console.warn("THREE.Skeleton bonInverses is the wrong length.");
            this.boneInverses = [];
            for (var a = 0, g = this.bones.length; a < g; a++) {
                this.boneInverses.push(new THREE.Matrix4())
            }
        }
    }
};
THREE.Skeleton.prototype.calculateInverses = function() {
    this.boneInverses = [];
    for (var a = 0, d = this.bones.length; a < d; a++) {
        var c = new THREE.Matrix4();
        if (this.bones[a]) {
            c.getInverse(this.bones[a].matrixWorld)
        }
        this.boneInverses.push(c)
    }
};
THREE.Skeleton.prototype.pose = function() {
    var c;
    for (var a = 0, d = this.bones.length; a < d; a++) {
        c = this.bones[a];
        if (c) {
            c.matrixWorld.getInverse(this.boneInverses[a])
        }
    }
    for (var a = 0, d = this.bones.length; a < d; a++) {
        c = this.bones[a];
        if (c) {
            if (c.parent) {
                c.matrix.getInverse(c.parent.matrixWorld);
                c.matrix.multiply(c.matrixWorld)
            } else {
                c.matrix.copy(c.matrixWorld)
            }
            c.matrix.decompose(c.position, c.quaternion, c.scale)
        }
    }
};
THREE.Skeleton.prototype.update = (function() {
    var a = new THREE.Matrix4();
    return function() {
        for (var c = 0, e = this.bones.length; c < e; c++) {
            var d = this.bones[c] ? this.bones[c].matrixWorld : this.identityMatrix;
            a.multiplyMatrices(d, this.boneInverses[c]);
            a.flattenToArrayOffset(this.boneMatrices, c * 16)
        }
        if (this.useVertexTexture) {
            this.boneTexture.needsUpdate = true
        }
    }
})();
THREE.SkinnedMesh = function(i, g, f) {
    THREE.Mesh.call(this, i, g);
    this.type = "SkinnedMesh";
    this.bindMode = "attached";
    this.bindMatrix = new THREE.Matrix4();
    this.bindMatrixInverse = new THREE.Matrix4();
    var e = [];
    if (this.geometry && this.geometry.bones !== undefined) {
        var j, k, c, a, l;
        for (var h = 0, d = this.geometry.bones.length; h < d; ++h) {
            k = this.geometry.bones[h];
            c = k.pos;
            a = k.rotq;
            l = k.scl;
            j = new THREE.Bone(this);
            e.push(j);
            j.name = k.name;
            j.position.set(c[0], c[1], c[2]);
            j.quaternion.set(a[0], a[1], a[2], a[3]);
            if (l !== undefined) {
                j.scale.set(l[0], l[1], l[2])
            } else {
                j.scale.set(1, 1, 1)
            }
        }
        for (var h = 0, d = this.geometry.bones.length; h < d; ++h) {
            k = this.geometry.bones[h];
            if (k.parent !== -1) {
                e[k.parent].add(e[h])
            } else {
                this.add(e[h])
            }
        }
    }
    this.normalizeSkinWeights();
    this.updateMatrixWorld(true);
    this.bind(new THREE.Skeleton(e, undefined, f))
};
THREE.SkinnedMesh.prototype = Object.create(THREE.Mesh.prototype);
THREE.SkinnedMesh.prototype.constructor = THREE.SkinnedMesh;
THREE.SkinnedMesh.prototype.bind = function(b, a) {
    this.skeleton = b;
    if (a === undefined) {
        this.updateMatrixWorld(true);
        a = this.matrixWorld
    }
    this.bindMatrix.copy(a);
    this.bindMatrixInverse.getInverse(a)
};
THREE.SkinnedMesh.prototype.pose = function() {
    this.skeleton.pose()
};
THREE.SkinnedMesh.prototype.normalizeSkinWeights = function() {
    if (this.geometry instanceof THREE.Geometry) {
        for (var b = 0; b < this.geometry.skinIndices.length; b++) {
            var a = this.geometry.skinWeights[b];
            var c = 1 / a.lengthManhattan();
            if (c !== Infinity) {
                a.multiplyScalar(c)
            } else {
                a.set(1)
            }
        }
    } else {}
};
THREE.SkinnedMesh.prototype.updateMatrixWorld = function(a) {
    THREE.Mesh.prototype.updateMatrixWorld.call(this, true);
    if (this.bindMode === "attached") {
        this.bindMatrixInverse.getInverse(this.matrixWorld)
    } else {
        if (this.bindMode === "detached") {
            this.bindMatrixInverse.getInverse(this.bindMatrix)
        } else {
            console.warn("THREE.SkinnedMesh unreckognized bindMode: " + this.bindMode)
        }
    }
};
THREE.SkinnedMesh.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.SkinnedMesh(this.geometry, this.material, this.useVertexTexture)
    }
    THREE.Mesh.prototype.clone.call(this, a);
    return a
};
THREE.MorphAnimMesh = function(b, a) {
    THREE.Mesh.call(this, b, a);
    this.type = "MorphAnimMesh";
    this.duration = 1000;
    this.mirroredLoop = false;
    this.time = 0;
    this.lastKeyframe = 0;
    this.currentKeyframe = 0;
    this.direction = 1;
    this.directionBackwards = false;
    this.setFrameRange(0, this.geometry.morphTargets.length - 1)
};
THREE.MorphAnimMesh.prototype = Object.create(THREE.Mesh.prototype);
THREE.MorphAnimMesh.prototype.constructor = THREE.MorphAnimMesh;
THREE.MorphAnimMesh.prototype.setFrameRange = function(b, a) {
    this.startKeyframe = b;
    this.endKeyframe = a;
    this.length = this.endKeyframe - this.startKeyframe + 1
};
THREE.MorphAnimMesh.prototype.setDirectionForward = function() {
    this.direction = 1;
    this.directionBackwards = false
};
THREE.MorphAnimMesh.prototype.setDirectionBackward = function() {
    this.direction = -1;
    this.directionBackwards = true
};
THREE.MorphAnimMesh.prototype.parseAnimations = function() {
    var g = this.geometry;
    if (!g.animations) {
        g.animations = {}
    }
    var a, l = g.animations;
    var f = /([a-z]+)_?(\d+)/;
    for (var d = 0, j = g.morphTargets.length; d < j; d++) {
        var k = g.morphTargets[d];
        var c = k.name.match(f);
        if (c && c.length > 1) {
            var h = c[1];
            var e = c[2];
            if (!l[h]) {
                l[h] = {
                    start: Infinity,
                    end: -Infinity
                }
            }
            var b = l[h];
            if (d < b.start) {
                b.start = d
            }
            if (d > b.end) {
                b.end = d
            }
            if (!a) {
                a = h
            }
        }
    }
    g.firstAnimation = a
};
THREE.MorphAnimMesh.prototype.setAnimationLabel = function(b, c, a) {
    if (!this.geometry.animations) {
        this.geometry.animations = {}
    }
    this.geometry.animations[b] = {
        start: c,
        end: a
    }
};
THREE.MorphAnimMesh.prototype.playAnimation = function(a, c) {
    var b = this.geometry.animations[a];
    if (b) {
        this.setFrameRange(b.start, b.end);
        this.duration = 1000 * ((b.end - b.start) / c);
        this.time = 0
    } else {
        console.warn("animation[" + a + "] undefined")
    }
};
THREE.MorphAnimMesh.prototype.updateAnimation = function(d) {
    var c = this.duration / this.length;
    this.time += this.direction * d;
    if (this.mirroredLoop) {
        if (this.time > this.duration || this.time < 0) {
            this.direction *= -1;
            if (this.time > this.duration) {
                this.time = this.duration;
                this.directionBackwards = true
            }
            if (this.time < 0) {
                this.time = 0;
                this.directionBackwards = false
            }
        }
    } else {
        this.time = this.time % this.duration;
        if (this.time < 0) {
            this.time += this.duration
        }
    }
    var a = this.startKeyframe + THREE.Math.clamp(Math.floor(this.time / c), 0, this.length - 1);
    if (a !== this.currentKeyframe) {
        this.morphTargetInfluences[this.lastKeyframe] = 0;
        this.morphTargetInfluences[this.currentKeyframe] = 1;
        this.morphTargetInfluences[a] = 0;
        this.lastKeyframe = this.currentKeyframe;
        this.currentKeyframe = a
    }
    var b = (this.time % c) / c;
    if (this.directionBackwards) {
        b = 1 - b
    }
    this.morphTargetInfluences[this.currentKeyframe] = b;
    this.morphTargetInfluences[this.lastKeyframe] = 1 - b
};
THREE.MorphAnimMesh.prototype.interpolateTargets = function(e, c, g) {
    var h = this.morphTargetInfluences;
    for (var f = 0, d = h.length; f < d; f++) {
        h[f] = 0
    }
    if (e > -1) {
        h[e] = 1 - g
    }
    if (c > -1) {
        h[c] = g
    }
};
THREE.MorphAnimMesh.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.MorphAnimMesh(this.geometry, this.material)
    }
    a.duration = this.duration;
    a.mirroredLoop = this.mirroredLoop;
    a.time = this.time;
    a.lastKeyframe = this.lastKeyframe;
    a.currentKeyframe = this.currentKeyframe;
    a.direction = this.direction;
    a.directionBackwards = this.directionBackwards;
    THREE.Mesh.prototype.clone.call(this, a);
    return a
};
THREE.LOD = function() {
    THREE.Object3D.call(this);
    this.objects = []
};
THREE.LOD.prototype = Object.create(THREE.Object3D.prototype);
THREE.LOD.prototype.constructor = THREE.LOD;
THREE.LOD.prototype.addLevel = function(b, c) {
    if (c === undefined) {
        c = 0
    }
    c = Math.abs(c);
    for (var a = 0; a < this.objects.length; a++) {
        if (c < this.objects[a].distance) {
            break
        }
    }
    this.objects.splice(a, 0, {
        distance: c,
        object: b
    });
    this.add(b)
};
THREE.LOD.prototype.getObjectForDistance = function(c) {
    for (var b = 1, a = this.objects.length; b < a; b++) {
        if (c < this.objects[b].distance) {
            break
        }
    }
    return this.objects[b - 1].object
};
THREE.LOD.prototype.raycast = (function() {
    var a = new THREE.Vector3();
    return function(b, c) {
        a.setFromMatrixPosition(this.matrixWorld);
        var d = b.ray.origin.distanceTo(a);
        this.getObjectForDistance(d).raycast(b, c)
    }
}());
THREE.LOD.prototype.update = function() {
    var b = new THREE.Vector3();
    var a = new THREE.Vector3();
    return function(e) {
        if (this.objects.length > 1) {
            b.setFromMatrixPosition(e.matrixWorld);
            a.setFromMatrixPosition(this.matrixWorld);
            var f = b.distanceTo(a);
            this.objects[0].object.visible = true;
            for (var d = 1, c = this.objects.length; d < c; d++) {
                if (f >= this.objects[d].distance) {
                    this.objects[d - 1].object.visible = false;
                    this.objects[d].object.visible = true
                } else {
                    break
                }
            }
            for (; d < c; d++) {
                this.objects[d].object.visible = false
            }
        }
    }
}();
THREE.LOD.prototype.clone = function(c) {
    if (c === undefined) {
        c = new THREE.LOD()
    }
    THREE.Object3D.prototype.clone.call(this, c);
    for (var d = 0, b = this.objects.length; d < b; d++) {
        var a = this.objects[d].object.clone();
        a.visible = d === 0;
        c.addLevel(a, this.objects[d].distance)
    }
    return c
};
THREE.Sprite = (function() {
    var d = new Uint16Array([0, 1, 2, 0, 2, 3]);
    var a = new Float32Array([-0.5, -0.5, 0, 0.5, -0.5, 0, 0.5, 0.5, 0, -0.5, 0.5, 0]);
    var b = new Float32Array([0, 0, 1, 0, 1, 1, 0, 1]);
    var c = new THREE.BufferGeometry();
    c.addAttribute("index", new THREE.BufferAttribute(d, 1));
    c.addAttribute("position", new THREE.BufferAttribute(a, 3));
    c.addAttribute("uv", new THREE.BufferAttribute(b, 2));
    return function(e) {
        THREE.Object3D.call(this);
        this.type = "Sprite";
        this.geometry = c;
        this.material = (e !== undefined) ? e : new THREE.SpriteMaterial()
    }
})();
THREE.Sprite.prototype = Object.create(THREE.Object3D.prototype);
THREE.Sprite.prototype.constructor = THREE.Sprite;
THREE.Sprite.prototype.raycast = (function() {
    var a = new THREE.Vector3();
    return function(b, c) {
        a.setFromMatrixPosition(this.matrixWorld);
        var d = b.ray.distanceToPoint(a);
        if (d > this.scale.x) {
            return
        }
        c.push({
            distance: d,
            point: this.position,
            face: null,
            object: this
        })
    }
}());
THREE.Sprite.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.Sprite(this.material)
    }
    THREE.Object3D.prototype.clone.call(this, a);
    return a
};
THREE.Particle = THREE.Sprite;
THREE.LensFlare = function(d, b, e, c, a) {
    THREE.Object3D.call(this);
    this.lensFlares = [];
    this.positionScreen = new THREE.Vector3();
    this.customUpdateCallback = undefined;
    if (d !== undefined) {
        this.add(d, b, e, c, a)
    }
};
THREE.LensFlare.prototype = Object.create(THREE.Object3D.prototype);
THREE.LensFlare.prototype.constructor = THREE.LensFlare;
THREE.LensFlare.prototype.add = function(e, c, f, d, a, b) {
    if (c === undefined) {
        c = -1
    }
    if (f === undefined) {
        f = 0
    }
    if (b === undefined) {
        b = 1
    }
    if (a === undefined) {
        a = new THREE.Color(16777215)
    }
    if (d === undefined) {
        d = THREE.NormalBlending
    }
    f = Math.min(f, Math.max(0, f));
    this.lensFlares.push({
        texture: e,
        size: c,
        distance: f,
        x: 0,
        y: 0,
        z: 0,
        scale: 1,
        rotation: 1,
        opacity: b,
        color: a,
        blending: d
    })
};
THREE.LensFlare.prototype.updateLensFlares = function() {
    var d, c = this.lensFlares.length;
    var b;
    var a = -this.positionScreen.x * 2;
    var e = -this.positionScreen.y * 2;
    for (d = 0; d < c; d++) {
        b = this.lensFlares[d];
        b.x = this.positionScreen.x + a * b.distance;
        b.y = this.positionScreen.y + e * b.distance;
        b.wantedRotation = b.x * Math.PI * 0.25;
        b.rotation += (b.wantedRotation - b.rotation) * 0.25
    }
};
THREE.Scene = function() {
    THREE.Object3D.call(this);
    this.type = "Scene";
    this.fog = null;
    this.overrideMaterial = null;
    this.autoUpdate = true
};
THREE.Scene.prototype = Object.create(THREE.Object3D.prototype);
THREE.Scene.prototype.constructor = THREE.Scene;
THREE.Scene.prototype.clone = function(a) {
    if (a === undefined) {
        a = new THREE.Scene()
    }
    THREE.Object3D.prototype.clone.call(this, a);
    if (this.fog !== null) {
        a.fog = this.fog.clone()
    }
    if (this.overrideMaterial !== null) {
        a.overrideMaterial = this.overrideMaterial.clone()
    }
    a.autoUpdate = this.autoUpdate;
    a.matrixAutoUpdate = this.matrixAutoUpdate;
    return a
};
THREE.Fog = function(b, c, a) {
    this.name = "";
    this.color = new THREE.Color(b);
    this.near = (c !== undefined) ? c : 1;
    this.far = (a !== undefined) ? a : 1000
};
THREE.Fog.prototype.clone = function() {
    return new THREE.Fog(this.color.getHex(), this.near, this.far)
};
THREE.FogExp2 = function(b, a) {
    this.name = "";
    this.color = new THREE.Color(b);
    this.density = (a !== undefined) ? a : 0.00025
};
THREE.FogExp2.prototype.clone = function() {
    return new THREE.FogExp2(this.color.getHex(), this.density)
};
THREE.ShaderChunk = {};
THREE.ShaderChunk.alphatest_fragment = "#ifdef ALPHATEST\n\n	if ( gl_FragColor.a < ALPHATEST ) discard;\n\n#endif\n";
THREE.ShaderChunk.lights_lambert_vertex = "vLightFront = vec3( 0.0 );\n\n#ifdef DOUBLE_SIDED\n\n	vLightBack = vec3( 0.0 );\n\n#endif\n\ntransformedNormal = normalize( transformedNormal );\n\n#if MAX_DIR_LIGHTS > 0\n\nfor( int i = 0; i < MAX_DIR_LIGHTS; i ++ ) {\n\n	vec4 lDirection = viewMatrix * vec4( directionalLightDirection[ i ], 0.0 );\n	vec3 dirVector = normalize( lDirection.xyz );\n\n	float dotProduct = dot( transformedNormal, dirVector );\n	vec3 directionalLightWeighting = vec3( max( dotProduct, 0.0 ) );\n\n	#ifdef DOUBLE_SIDED\n\n		vec3 directionalLightWeightingBack = vec3( max( -dotProduct, 0.0 ) );\n\n		#ifdef WRAP_AROUND\n\n			vec3 directionalLightWeightingHalfBack = vec3( max( -0.5 * dotProduct + 0.5, 0.0 ) );\n\n		#endif\n\n	#endif\n\n	#ifdef WRAP_AROUND\n\n		vec3 directionalLightWeightingHalf = vec3( max( 0.5 * dotProduct + 0.5, 0.0 ) );\n		directionalLightWeighting = mix( directionalLightWeighting, directionalLightWeightingHalf, wrapRGB );\n\n		#ifdef DOUBLE_SIDED\n\n			directionalLightWeightingBack = mix( directionalLightWeightingBack, directionalLightWeightingHalfBack, wrapRGB );\n\n		#endif\n\n	#endif\n\n	vLightFront += directionalLightColor[ i ] * directionalLightWeighting;\n\n	#ifdef DOUBLE_SIDED\n\n		vLightBack += directionalLightColor[ i ] * directionalLightWeightingBack;\n\n	#endif\n\n}\n\n#endif\n\n#if MAX_POINT_LIGHTS > 0\n\n	for( int i = 0; i < MAX_POINT_LIGHTS; i ++ ) {\n\n		vec4 lPosition = viewMatrix * vec4( pointLightPosition[ i ], 1.0 );\n		vec3 lVector = lPosition.xyz - mvPosition.xyz;\n\n		float lDistance = 1.0;\n		if ( pointLightDistance[ i ] > 0.0 )\n			lDistance = 1.0 - min( ( length( lVector ) / pointLightDistance[ i ] ), 1.0 );\n\n		lVector = normalize( lVector );\n		float dotProduct = dot( transformedNormal, lVector );\n\n		vec3 pointLightWeighting = vec3( max( dotProduct, 0.0 ) );\n\n		#ifdef DOUBLE_SIDED\n\n			vec3 pointLightWeightingBack = vec3( max( -dotProduct, 0.0 ) );\n\n			#ifdef WRAP_AROUND\n\n				vec3 pointLightWeightingHalfBack = vec3( max( -0.5 * dotProduct + 0.5, 0.0 ) );\n\n			#endif\n\n		#endif\n\n		#ifdef WRAP_AROUND\n\n			vec3 pointLightWeightingHalf = vec3( max( 0.5 * dotProduct + 0.5, 0.0 ) );\n			pointLightWeighting = mix( pointLightWeighting, pointLightWeightingHalf, wrapRGB );\n\n			#ifdef DOUBLE_SIDED\n\n				pointLightWeightingBack = mix( pointLightWeightingBack, pointLightWeightingHalfBack, wrapRGB );\n\n			#endif\n\n		#endif\n\n		vLightFront += pointLightColor[ i ] * pointLightWeighting * lDistance;\n\n		#ifdef DOUBLE_SIDED\n\n			vLightBack += pointLightColor[ i ] * pointLightWeightingBack * lDistance;\n\n		#endif\n\n	}\n\n#endif\n\n#if MAX_SPOT_LIGHTS > 0\n\n	for( int i = 0; i < MAX_SPOT_LIGHTS; i ++ ) {\n\n		vec4 lPosition = viewMatrix * vec4( spotLightPosition[ i ], 1.0 );\n		vec3 lVector = lPosition.xyz - mvPosition.xyz;\n\n		float spotEffect = dot( spotLightDirection[ i ], normalize( spotLightPosition[ i ] - worldPosition.xyz ) );\n\n		if ( spotEffect > spotLightAngleCos[ i ] ) {\n\n			spotEffect = max( pow( max( spotEffect, 0.0 ), spotLightExponent[ i ] ), 0.0 );\n\n			float lDistance = 1.0;\n			if ( spotLightDistance[ i ] > 0.0 )\n				lDistance = 1.0 - min( ( length( lVector ) / spotLightDistance[ i ] ), 1.0 );\n\n			lVector = normalize( lVector );\n\n			float dotProduct = dot( transformedNormal, lVector );\n			vec3 spotLightWeighting = vec3( max( dotProduct, 0.0 ) );\n\n			#ifdef DOUBLE_SIDED\n\n				vec3 spotLightWeightingBack = vec3( max( -dotProduct, 0.0 ) );\n\n				#ifdef WRAP_AROUND\n\n					vec3 spotLightWeightingHalfBack = vec3( max( -0.5 * dotProduct + 0.5, 0.0 ) );\n\n				#endif\n\n			#endif\n\n			#ifdef WRAP_AROUND\n\n				vec3 spotLightWeightingHalf = vec3( max( 0.5 * dotProduct + 0.5, 0.0 ) );\n				spotLightWeighting = mix( spotLightWeighting, spotLightWeightingHalf, wrapRGB );\n\n				#ifdef DOUBLE_SIDED\n\n					spotLightWeightingBack = mix( spotLightWeightingBack, spotLightWeightingHalfBack, wrapRGB );\n\n				#endif\n\n			#endif\n\n			vLightFront += spotLightColor[ i ] * spotLightWeighting * lDistance * spotEffect;\n\n			#ifdef DOUBLE_SIDED\n\n				vLightBack += spotLightColor[ i ] * spotLightWeightingBack * lDistance * spotEffect;\n\n			#endif\n\n		}\n\n	}\n\n#endif\n\n#if MAX_HEMI_LIGHTS > 0\n\n	for( int i = 0; i < MAX_HEMI_LIGHTS; i ++ ) {\n\n		vec4 lDirection = viewMatrix * vec4( hemisphereLightDirection[ i ], 0.0 );\n		vec3 lVector = normalize( lDirection.xyz );\n\n		float dotProduct = dot( transformedNormal, lVector );\n\n		float hemiDiffuseWeight = 0.5 * dotProduct + 0.5;\n		float hemiDiffuseWeightBack = -0.5 * dotProduct + 0.5;\n\n		vLightFront += mix( hemisphereLightGroundColor[ i ], hemisphereLightSkyColor[ i ], hemiDiffuseWeight );\n\n		#ifdef DOUBLE_SIDED\n\n			vLightBack += mix( hemisphereLightGroundColor[ i ], hemisphereLightSkyColor[ i ], hemiDiffuseWeightBack );\n\n		#endif\n\n	}\n\n#endif\n\nvLightFront = vLightFront * diffuse + ambient * ambientLightColor + emissive;\n\n#ifdef DOUBLE_SIDED\n\n	vLightBack = vLightBack * diffuse + ambient * ambientLightColor + emissive;\n\n#endif";
THREE.ShaderChunk.map_particle_pars_fragment = "#ifdef USE_MAP\n\n	uniform sampler2D map;\n\n#endif";
THREE.ShaderChunk.default_vertex = "#ifdef USE_SKINNING\n\n	vec4 mvPosition = modelViewMatrix * skinned;\n\n#elif defined( USE_MORPHTARGETS )\n\n	vec4 mvPosition = modelViewMatrix * vec4( morphed, 1.0 );\n\n#else\n\n	vec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );\n\n#endif\n\ngl_Position = projectionMatrix * mvPosition;\n";
THREE.ShaderChunk.map_pars_fragment = "#if defined( USE_MAP ) || defined( USE_BUMPMAP ) || defined( USE_NORMALMAP ) || defined( USE_SPECULARMAP ) || defined( USE_ALPHAMAP )\n\n	varying vec2 vUv;\n\n#endif\n\n#ifdef USE_MAP\n\n	uniform sampler2D map;\n\n#endif";
THREE.ShaderChunk.skinnormal_vertex = "#ifdef USE_SKINNING\n\n	mat4 skinMatrix = mat4( 0.0 );\n	skinMatrix += skinWeight.x * boneMatX;\n	skinMatrix += skinWeight.y * boneMatY;\n	skinMatrix += skinWeight.z * boneMatZ;\n	skinMatrix += skinWeight.w * boneMatW;\n	skinMatrix  = bindMatrixInverse * skinMatrix * bindMatrix;\n\n	#ifdef USE_MORPHNORMALS\n\n	vec4 skinnedNormal = skinMatrix * vec4( morphedNormal, 0.0 );\n\n	#else\n\n	vec4 skinnedNormal = skinMatrix * vec4( normal, 0.0 );\n\n	#endif\n\n#endif\n";
THREE.ShaderChunk.logdepthbuf_pars_vertex = "#ifdef USE_LOGDEPTHBUF\n\n	#ifdef USE_LOGDEPTHBUF_EXT\n\n		varying float vFragDepth;\n\n	#endif\n\n	uniform float logDepthBufFC;\n\n#endif";
THREE.ShaderChunk.lightmap_pars_vertex = "#ifdef USE_LIGHTMAP\n\n	varying vec2 vUv2;\n\n#endif";
THREE.ShaderChunk.lights_phong_fragment = "vec3 normal = normalize( vNormal );\nvec3 viewPosition = normalize( vViewPosition );\n\n#ifdef DOUBLE_SIDED\n\n	normal = normal * ( -1.0 + 2.0 * float( gl_FrontFacing ) );\n\n#endif\n\n#ifdef USE_NORMALMAP\n\n	normal = perturbNormal2Arb( -vViewPosition, normal );\n\n#elif defined( USE_BUMPMAP )\n\n	normal = perturbNormalArb( -vViewPosition, normal, dHdxy_fwd() );\n\n#endif\n\n#if MAX_POINT_LIGHTS > 0\n\n	vec3 pointDiffuse = vec3( 0.0 );\n	vec3 pointSpecular = vec3( 0.0 );\n\n	for ( int i = 0; i < MAX_POINT_LIGHTS; i ++ ) {\n\n		vec4 lPosition = viewMatrix * vec4( pointLightPosition[ i ], 1.0 );\n		vec3 lVector = lPosition.xyz + vViewPosition.xyz;\n\n		float lDistance = 1.0;\n		if ( pointLightDistance[ i ] > 0.0 )\n			lDistance = 1.0 - min( ( length( lVector ) / pointLightDistance[ i ] ), 1.0 );\n\n		lVector = normalize( lVector );\n\n				// diffuse\n\n		float dotProduct = dot( normal, lVector );\n\n		#ifdef WRAP_AROUND\n\n			float pointDiffuseWeightFull = max( dotProduct, 0.0 );\n			float pointDiffuseWeightHalf = max( 0.5 * dotProduct + 0.5, 0.0 );\n\n			vec3 pointDiffuseWeight = mix( vec3( pointDiffuseWeightFull ), vec3( pointDiffuseWeightHalf ), wrapRGB );\n\n		#else\n\n			float pointDiffuseWeight = max( dotProduct, 0.0 );\n\n		#endif\n\n		pointDiffuse += diffuse * pointLightColor[ i ] * pointDiffuseWeight * lDistance;\n\n				// specular\n\n		vec3 pointHalfVector = normalize( lVector + viewPosition );\n		float pointDotNormalHalf = max( dot( normal, pointHalfVector ), 0.0 );\n		float pointSpecularWeight = specularStrength * max( pow( pointDotNormalHalf, shininess ), 0.0 );\n\n		float specularNormalization = ( shininess + 2.0 ) / 8.0;\n\n		vec3 schlick = specular + vec3( 1.0 - specular ) * pow( max( 1.0 - dot( lVector, pointHalfVector ), 0.0 ), 5.0 );\n		pointSpecular += schlick * pointLightColor[ i ] * pointSpecularWeight * pointDiffuseWeight * lDistance * specularNormalization;\n\n	}\n\n#endif\n\n#if MAX_SPOT_LIGHTS > 0\n\n	vec3 spotDiffuse = vec3( 0.0 );\n	vec3 spotSpecular = vec3( 0.0 );\n\n	for ( int i = 0; i < MAX_SPOT_LIGHTS; i ++ ) {\n\n		vec4 lPosition = viewMatrix * vec4( spotLightPosition[ i ], 1.0 );\n		vec3 lVector = lPosition.xyz + vViewPosition.xyz;\n\n		float lDistance = 1.0;\n		if ( spotLightDistance[ i ] > 0.0 )\n			lDistance = 1.0 - min( ( length( lVector ) / spotLightDistance[ i ] ), 1.0 );\n\n		lVector = normalize( lVector );\n\n		float spotEffect = dot( spotLightDirection[ i ], normalize( spotLightPosition[ i ] - vWorldPosition ) );\n\n		if ( spotEffect > spotLightAngleCos[ i ] ) {\n\n			spotEffect = max( pow( max( spotEffect, 0.0 ), spotLightExponent[ i ] ), 0.0 );\n\n					// diffuse\n\n			float dotProduct = dot( normal, lVector );\n\n			#ifdef WRAP_AROUND\n\n				float spotDiffuseWeightFull = max( dotProduct, 0.0 );\n				float spotDiffuseWeightHalf = max( 0.5 * dotProduct + 0.5, 0.0 );\n\n				vec3 spotDiffuseWeight = mix( vec3( spotDiffuseWeightFull ), vec3( spotDiffuseWeightHalf ), wrapRGB );\n\n			#else\n\n				float spotDiffuseWeight = max( dotProduct, 0.0 );\n\n			#endif\n\n			spotDiffuse += diffuse * spotLightColor[ i ] * spotDiffuseWeight * lDistance * spotEffect;\n\n					// specular\n\n			vec3 spotHalfVector = normalize( lVector + viewPosition );\n			float spotDotNormalHalf = max( dot( normal, spotHalfVector ), 0.0 );\n			float spotSpecularWeight = specularStrength * max( pow( spotDotNormalHalf, shininess ), 0.0 );\n\n			float specularNormalization = ( shininess + 2.0 ) / 8.0;\n\n			vec3 schlick = specular + vec3( 1.0 - specular ) * pow( max( 1.0 - dot( lVector, spotHalfVector ), 0.0 ), 5.0 );\n			spotSpecular += schlick * spotLightColor[ i ] * spotSpecularWeight * spotDiffuseWeight * lDistance * specularNormalization * spotEffect;\n\n		}\n\n	}\n\n#endif\n\n#if MAX_DIR_LIGHTS > 0\n\n	vec3 dirDiffuse = vec3( 0.0 );\n	vec3 dirSpecular = vec3( 0.0 );\n\n	for( int i = 0; i < MAX_DIR_LIGHTS; i ++ ) {\n\n		vec4 lDirection = viewMatrix * vec4( directionalLightDirection[ i ], 0.0 );\n		vec3 dirVector = normalize( lDirection.xyz );\n\n				// diffuse\n\n		float dotProduct = dot( normal, dirVector );\n\n		#ifdef WRAP_AROUND\n\n			float dirDiffuseWeightFull = max( dotProduct, 0.0 );\n			float dirDiffuseWeightHalf = max( 0.5 * dotProduct + 0.5, 0.0 );\n\n			vec3 dirDiffuseWeight = mix( vec3( dirDiffuseWeightFull ), vec3( dirDiffuseWeightHalf ), wrapRGB );\n\n		#else\n\n			float dirDiffuseWeight = max( dotProduct, 0.0 );\n\n		#endif\n\n		dirDiffuse += diffuse * directionalLightColor[ i ] * dirDiffuseWeight;\n\n		// specular\n\n		vec3 dirHalfVector = normalize( dirVector + viewPosition );\n		float dirDotNormalHalf = max( dot( normal, dirHalfVector ), 0.0 );\n		float dirSpecularWeight = specularStrength * max( pow( dirDotNormalHalf, shininess ), 0.0 );\n\n		/*\n		// fresnel term from skin shader\n		const float F0 = 0.128;\n\n		float base = 1.0 - dot( viewPosition, dirHalfVector );\n		float exponential = pow( base, 5.0 );\n\n		float fresnel = exponential + F0 * ( 1.0 - exponential );\n		*/\n\n		/*\n		// fresnel term from fresnel shader\n		const float mFresnelBias = 0.08;\n		const float mFresnelScale = 0.3;\n		const float mFresnelPower = 5.0;\n\n		float fresnel = mFresnelBias + mFresnelScale * pow( 1.0 + dot( normalize( -viewPosition ), normal ), mFresnelPower );\n		*/\n\n		float specularNormalization = ( shininess + 2.0 ) / 8.0;\n\n		// 		dirSpecular += specular * directionalLightColor[ i ] * dirSpecularWeight * dirDiffuseWeight * specularNormalization * fresnel;\n\n		vec3 schlick = specular + vec3( 1.0 - specular ) * pow( max( 1.0 - dot( dirVector, dirHalfVector ), 0.0 ), 5.0 );\n		dirSpecular += schlick * directionalLightColor[ i ] * dirSpecularWeight * dirDiffuseWeight * specularNormalization;\n\n\n	}\n\n#endif\n\n#if MAX_HEMI_LIGHTS > 0\n\n	vec3 hemiDiffuse = vec3( 0.0 );\n	vec3 hemiSpecular = vec3( 0.0 );\n\n	for( int i = 0; i < MAX_HEMI_LIGHTS; i ++ ) {\n\n		vec4 lDirection = viewMatrix * vec4( hemisphereLightDirection[ i ], 0.0 );\n		vec3 lVector = normalize( lDirection.xyz );\n\n		// diffuse\n\n		float dotProduct = dot( normal, lVector );\n		float hemiDiffuseWeight = 0.5 * dotProduct + 0.5;\n\n		vec3 hemiColor = mix( hemisphereLightGroundColor[ i ], hemisphereLightSkyColor[ i ], hemiDiffuseWeight );\n\n		hemiDiffuse += diffuse * hemiColor;\n\n		// specular (sky light)\n\n		vec3 hemiHalfVectorSky = normalize( lVector + viewPosition );\n		float hemiDotNormalHalfSky = 0.5 * dot( normal, hemiHalfVectorSky ) + 0.5;\n		float hemiSpecularWeightSky = specularStrength * max( pow( max( hemiDotNormalHalfSky, 0.0 ), shininess ), 0.0 );\n\n		// specular (ground light)\n\n		vec3 lVectorGround = -lVector;\n\n		vec3 hemiHalfVectorGround = normalize( lVectorGround + viewPosition );\n		float hemiDotNormalHalfGround = 0.5 * dot( normal, hemiHalfVectorGround ) + 0.5;\n		float hemiSpecularWeightGround = specularStrength * max( pow( max( hemiDotNormalHalfGround, 0.0 ), shininess ), 0.0 );\n\n		float dotProductGround = dot( normal, lVectorGround );\n\n		float specularNormalization = ( shininess + 2.0 ) / 8.0;\n\n		vec3 schlickSky = specular + vec3( 1.0 - specular ) * pow( max( 1.0 - dot( lVector, hemiHalfVectorSky ), 0.0 ), 5.0 );\n		vec3 schlickGround = specular + vec3( 1.0 - specular ) * pow( max( 1.0 - dot( lVectorGround, hemiHalfVectorGround ), 0.0 ), 5.0 );\n		hemiSpecular += hemiColor * specularNormalization * ( schlickSky * hemiSpecularWeightSky * max( dotProduct, 0.0 ) + schlickGround * hemiSpecularWeightGround * max( dotProductGround, 0.0 ) );\n\n	}\n\n#endif\n\nvec3 totalDiffuse = vec3( 0.0 );\nvec3 totalSpecular = vec3( 0.0 );\n\n#if MAX_DIR_LIGHTS > 0\n\n	totalDiffuse += dirDiffuse;\n	totalSpecular += dirSpecular;\n\n#endif\n\n#if MAX_HEMI_LIGHTS > 0\n\n	totalDiffuse += hemiDiffuse;\n	totalSpecular += hemiSpecular;\n\n#endif\n\n#if MAX_POINT_LIGHTS > 0\n\n	totalDiffuse += pointDiffuse;\n	totalSpecular += pointSpecular;\n\n#endif\n\n#if MAX_SPOT_LIGHTS > 0\n\n	totalDiffuse += spotDiffuse;\n	totalSpecular += spotSpecular;\n\n#endif\n\n#ifdef METAL\n\n	gl_FragColor.xyz = gl_FragColor.xyz * ( emissive + totalDiffuse + ambientLightColor * ambient + totalSpecular );\n\n#else\n\n	gl_FragColor.xyz = gl_FragColor.xyz * ( emissive + totalDiffuse + ambientLightColor * ambient ) + totalSpecular;\n\n#endif";
THREE.ShaderChunk.fog_pars_fragment = "#ifdef USE_FOG\n\n	uniform vec3 fogColor;\n\n	#ifdef FOG_EXP2\n\n		uniform float fogDensity;\n\n	#else\n\n		uniform float fogNear;\n		uniform float fogFar;\n	#endif\n\n#endif";
THREE.ShaderChunk.morphnormal_vertex = "#ifdef USE_MORPHNORMALS\n\n	vec3 morphedNormal = vec3( 0.0 );\n\n	morphedNormal += ( morphNormal0 - normal ) * morphTargetInfluences[ 0 ];\n	morphedNormal += ( morphNormal1 - normal ) * morphTargetInfluences[ 1 ];\n	morphedNormal += ( morphNormal2 - normal ) * morphTargetInfluences[ 2 ];\n	morphedNormal += ( morphNormal3 - normal ) * morphTargetInfluences[ 3 ];\n\n	morphedNormal += normal;\n\n#endif";
THREE.ShaderChunk.envmap_pars_fragment = "#ifdef USE_ENVMAP\n\n	uniform float reflectivity;\n	#ifdef ENVMAP_TYPE_CUBE\n		uniform samplerCube envMap;\n	#else\n		uniform sampler2D envMap;\n	#endif\n	uniform float flipEnvMap;\n\n	#if defined( USE_BUMPMAP ) || defined( USE_NORMALMAP ) || defined( PHONG )\n\n		uniform float refractionRatio;\n\n	#else\n\n		varying vec3 vReflect;\n\n	#endif\n\n#endif\n";
THREE.ShaderChunk.logdepthbuf_fragment = "#if defined(USE_LOGDEPTHBUF) && defined(USE_LOGDEPTHBUF_EXT)\n\n	gl_FragDepthEXT = log2(vFragDepth) * logDepthBufFC * 0.5;\n\n#endif";
THREE.ShaderChunk.normalmap_pars_fragment = "#ifdef USE_NORMALMAP\n\n	uniform sampler2D normalMap;\n	uniform vec2 normalScale;\n\n			// Per-Pixel Tangent Space Normal Mapping\n			// http://hacksoflife.blogspot.ch/2009/11/per-pixel-tangent-space-normal-mapping.html\n\n	vec3 perturbNormal2Arb( vec3 eye_pos, vec3 surf_norm ) {\n\n		vec3 q0 = dFdx( eye_pos.xyz );\n		vec3 q1 = dFdy( eye_pos.xyz );\n		vec2 st0 = dFdx( vUv.st );\n		vec2 st1 = dFdy( vUv.st );\n\n		vec3 S = normalize( q0 * st1.t - q1 * st0.t );\n		vec3 T = normalize( -q0 * st1.s + q1 * st0.s );\n		vec3 N = normalize( surf_norm );\n\n		vec3 mapN = texture2D( normalMap, vUv ).xyz * 2.0 - 1.0;\n		mapN.xy = normalScale * mapN.xy;\n		mat3 tsn = mat3( S, T, N );\n		return normalize( tsn * mapN );\n\n	}\n\n#endif\n";
THREE.ShaderChunk.lights_phong_pars_vertex = "#if MAX_SPOT_LIGHTS > 0 || defined( USE_BUMPMAP ) || defined( USE_ENVMAP )\n\n	varying vec3 vWorldPosition;\n\n#endif\n";
THREE.ShaderChunk.lightmap_pars_fragment = "#ifdef USE_LIGHTMAP\n\n	varying vec2 vUv2;\n	uniform sampler2D lightMap;\n\n#endif";
THREE.ShaderChunk.shadowmap_vertex = "#ifdef USE_SHADOWMAP\n\n	for( int i = 0; i < MAX_SHADOWS; i ++ ) {\n\n		vShadowCoord[ i ] = shadowMatrix[ i ] * worldPosition;\n\n	}\n\n#endif";
THREE.ShaderChunk.lights_phong_vertex = "#if MAX_SPOT_LIGHTS > 0 || defined( USE_BUMPMAP ) || defined( USE_ENVMAP )\n\n	vWorldPosition = worldPosition.xyz;\n\n#endif";
THREE.ShaderChunk.map_fragment = "#ifdef USE_MAP\n\n	vec4 texelColor = texture2D( map, vUv );\n\n	#ifdef GAMMA_INPUT\n\n		texelColor.xyz *= texelColor.xyz;\n\n	#endif\n\n	gl_FragColor = gl_FragColor * texelColor;\n\n#endif";
THREE.ShaderChunk.lightmap_vertex = "#ifdef USE_LIGHTMAP\n\n	vUv2 = uv2;\n\n#endif";
THREE.ShaderChunk.map_particle_fragment = "#ifdef USE_MAP\n\n	gl_FragColor = gl_FragColor * texture2D( map, vec2( gl_PointCoord.x, 1.0 - gl_PointCoord.y ) );\n\n#endif";
THREE.ShaderChunk.color_pars_fragment = "#ifdef USE_COLOR\n\n	varying vec3 vColor;\n\n#endif\n";
THREE.ShaderChunk.color_vertex = "#ifdef USE_COLOR\n\n	#ifdef GAMMA_INPUT\n\n		vColor = color * color;\n\n	#else\n\n		vColor = color;\n\n	#endif\n\n#endif";
THREE.ShaderChunk.skinning_vertex = "#ifdef USE_SKINNING\n\n	#ifdef USE_MORPHTARGETS\n\n	vec4 skinVertex = bindMatrix * vec4( morphed, 1.0 );\n\n	#else\n\n	vec4 skinVertex = bindMatrix * vec4( position, 1.0 );\n\n	#endif\n\n	vec4 skinned = vec4( 0.0 );\n	skinned += boneMatX * skinVertex * skinWeight.x;\n	skinned += boneMatY * skinVertex * skinWeight.y;\n	skinned += boneMatZ * skinVertex * skinWeight.z;\n	skinned += boneMatW * skinVertex * skinWeight.w;\n	skinned  = bindMatrixInverse * skinned;\n\n#endif\n";
THREE.ShaderChunk.envmap_pars_vertex = "#if defined( USE_ENVMAP ) && ! defined( USE_BUMPMAP ) && ! defined( USE_NORMALMAP ) && ! defined( PHONG )\n\n	varying vec3 vReflect;\n\n	uniform float refractionRatio;\n\n#endif\n";
THREE.ShaderChunk.linear_to_gamma_fragment = "#ifdef GAMMA_OUTPUT\n\n	gl_FragColor.xyz = sqrt( gl_FragColor.xyz );\n\n#endif";
THREE.ShaderChunk.color_pars_vertex = "#ifdef USE_COLOR\n\n	varying vec3 vColor;\n\n#endif";
THREE.ShaderChunk.lights_lambert_pars_vertex = "uniform vec3 ambient;\nuniform vec3 diffuse;\nuniform vec3 emissive;\n\nuniform vec3 ambientLightColor;\n\n#if MAX_DIR_LIGHTS > 0\n\n	uniform vec3 directionalLightColor[ MAX_DIR_LIGHTS ];\n	uniform vec3 directionalLightDirection[ MAX_DIR_LIGHTS ];\n\n#endif\n\n#if MAX_HEMI_LIGHTS > 0\n\n	uniform vec3 hemisphereLightSkyColor[ MAX_HEMI_LIGHTS ];\n	uniform vec3 hemisphereLightGroundColor[ MAX_HEMI_LIGHTS ];\n	uniform vec3 hemisphereLightDirection[ MAX_HEMI_LIGHTS ];\n\n#endif\n\n#if MAX_POINT_LIGHTS > 0\n\n	uniform vec3 pointLightColor[ MAX_POINT_LIGHTS ];\n	uniform vec3 pointLightPosition[ MAX_POINT_LIGHTS ];\n	uniform float pointLightDistance[ MAX_POINT_LIGHTS ];\n\n#endif\n\n#if MAX_SPOT_LIGHTS > 0\n\n	uniform vec3 spotLightColor[ MAX_SPOT_LIGHTS ];\n	uniform vec3 spotLightPosition[ MAX_SPOT_LIGHTS ];\n	uniform vec3 spotLightDirection[ MAX_SPOT_LIGHTS ];\n	uniform float spotLightDistance[ MAX_SPOT_LIGHTS ];\n	uniform float spotLightAngleCos[ MAX_SPOT_LIGHTS ];\n	uniform float spotLightExponent[ MAX_SPOT_LIGHTS ];\n\n#endif\n\n#ifdef WRAP_AROUND\n\n	uniform vec3 wrapRGB;\n\n#endif\n";
THREE.ShaderChunk.map_pars_vertex = "#if defined( USE_MAP ) || defined( USE_BUMPMAP ) || defined( USE_NORMALMAP ) || defined( USE_SPECULARMAP ) || defined( USE_ALPHAMAP )\n\n	varying vec2 vUv;\n	uniform vec4 offsetRepeat;\n\n#endif\n";
THREE.ShaderChunk.envmap_fragment = "#ifdef USE_ENVMAP\n\n	#if defined( USE_BUMPMAP ) || defined( USE_NORMALMAP ) || defined( PHONG )\n\n		vec3 cameraToVertex = normalize( vWorldPosition - cameraPosition );\n\n		// http://en.wikibooks.org/wiki/GLSL_Programming/Applying_Matrix_Transformations\n		// Transforming Normal Vectors with the Inverse Transformation\n\n		vec3 worldNormal = normalize( vec3( vec4( normal, 0.0 ) * viewMatrix ) );\n\n		#ifdef ENVMAP_MODE_REFLECTION\n\n			vec3 reflectVec = reflect( cameraToVertex, worldNormal );\n\n		#else\n\n			vec3 reflectVec = refract( cameraToVertex, worldNormal, refractionRatio );\n\n		#endif\n\n	#else\n\n		vec3 reflectVec = vReflect;\n\n	#endif\n\n	#ifdef DOUBLE_SIDED\n		float flipNormal = ( -1.0 + 2.0 * float( gl_FrontFacing ) );\n	#else\n		float flipNormal = 1.0;\n	#endif\n\n	#ifdef ENVMAP_TYPE_CUBE\n		vec4 envColor = textureCube( envMap, flipNormal * vec3( flipEnvMap * reflectVec.x, reflectVec.yz ) );\n\n	#elif defined( ENVMAP_TYPE_EQUIREC )\n		vec2 sampleUV;\n		sampleUV.y = clamp( flipNormal * reflectVec.y * 0.5 + 0.5, 0.0, 1.0);\n		sampleUV.x = atan( flipNormal * reflectVec.z, flipNormal * reflectVec.x ) * 0.15915494309189533576888376337251 + 0.5; // reciprocal( 2 PI ) + 0.5\n		vec4 envColor = texture2D( envMap, sampleUV );\n		\n	#elif defined( ENVMAP_TYPE_SPHERE )\n		vec3 reflectView = flipNormal * normalize((viewMatrix * vec4( reflectVec, 0.0 )).xyz + vec3(0.0,0.0,1.0));\n		vec4 envColor = texture2D( envMap, reflectView.xy * 0.5 + 0.5 );\n	#endif\n\n	#ifdef GAMMA_INPUT\n\n		envColor.xyz *= envColor.xyz;\n\n	#endif\n\n	#ifdef ENVMAP_BLENDING_MULTIPLY\n\n		gl_FragColor.xyz = mix( gl_FragColor.xyz, gl_FragColor.xyz * envColor.xyz, specularStrength * reflectivity );\n\n	#elif defined( ENVMAP_BLENDING_MIX )\n\n		gl_FragColor.xyz = mix( gl_FragColor.xyz, envColor.xyz, specularStrength * reflectivity );\n\n	#elif defined( ENVMAP_BLENDING_ADD )\n\n		gl_FragColor.xyz += envColor.xyz * specularStrength * reflectivity;\n\n	#endif\n\n#endif\n";
THREE.ShaderChunk.specularmap_pars_fragment = "#ifdef USE_SPECULARMAP\n\n	uniform sampler2D specularMap;\n\n#endif";
THREE.ShaderChunk.logdepthbuf_vertex = "#ifdef USE_LOGDEPTHBUF\n\n	gl_Position.z = log2(max(1e-6, gl_Position.w + 1.0)) * logDepthBufFC;\n\n	#ifdef USE_LOGDEPTHBUF_EXT\n\n		vFragDepth = 1.0 + gl_Position.w;\n\n#else\n\n		gl_Position.z = (gl_Position.z - 1.0) * gl_Position.w;\n\n	#endif\n\n#endif";
THREE.ShaderChunk.morphtarget_pars_vertex = "#ifdef USE_MORPHTARGETS\n\n	#ifndef USE_MORPHNORMALS\n\n	uniform float morphTargetInfluences[ 8 ];\n\n	#else\n\n	uniform float morphTargetInfluences[ 4 ];\n\n	#endif\n\n#endif";
THREE.ShaderChunk.specularmap_fragment = "float specularStrength;\n\n#ifdef USE_SPECULARMAP\n\n	vec4 texelSpecular = texture2D( specularMap, vUv );\n	specularStrength = texelSpecular.r;\n\n#else\n\n	specularStrength = 1.0;\n\n#endif";
THREE.ShaderChunk.fog_fragment = "#ifdef USE_FOG\n\n	#ifdef USE_LOGDEPTHBUF_EXT\n\n		float depth = gl_FragDepthEXT / gl_FragCoord.w;\n\n	#else\n\n		float depth = gl_FragCoord.z / gl_FragCoord.w;\n\n	#endif\n\n	#ifdef FOG_EXP2\n\n		const float LOG2 = 1.442695;\n		float fogFactor = exp2( - fogDensity * fogDensity * depth * depth * LOG2 );\n		fogFactor = 1.0 - clamp( fogFactor, 0.0, 1.0 );\n\n	#else\n\n		float fogFactor = smoothstep( fogNear, fogFar, depth );\n\n	#endif\n	\n	gl_FragColor = mix( gl_FragColor, vec4( fogColor, gl_FragColor.w ), fogFactor );\n\n#endif";
THREE.ShaderChunk.bumpmap_pars_fragment = "#ifdef USE_BUMPMAP\n\n	uniform sampler2D bumpMap;\n	uniform float bumpScale;\n\n			// Derivative maps - bump mapping unparametrized surfaces by Morten Mikkelsen\n			//	http://mmikkelsen3d.blogspot.sk/2011/07/derivative-maps.html\n\n			// Evaluate the derivative of the height w.r.t. screen-space using forward differencing (listing 2)\n\n	vec2 dHdxy_fwd() {\n\n		vec2 dSTdx = dFdx( vUv );\n		vec2 dSTdy = dFdy( vUv );\n\n		float Hll = bumpScale * texture2D( bumpMap, vUv ).x;\n		float dBx = bumpScale * texture2D( bumpMap, vUv + dSTdx ).x - Hll;\n		float dBy = bumpScale * texture2D( bumpMap, vUv + dSTdy ).x - Hll;\n\n		return vec2( dBx, dBy );\n\n	}\n\n	vec3 perturbNormalArb( vec3 surf_pos, vec3 surf_norm, vec2 dHdxy ) {\n\n		vec3 vSigmaX = dFdx( surf_pos );\n		vec3 vSigmaY = dFdy( surf_pos );\n		vec3 vN = surf_norm;		// normalized\n\n		vec3 R1 = cross( vSigmaY, vN );\n		vec3 R2 = cross( vN, vSigmaX );\n\n		float fDet = dot( vSigmaX, R1 );\n\n		vec3 vGrad = sign( fDet ) * ( dHdxy.x * R1 + dHdxy.y * R2 );\n		return normalize( abs( fDet ) * surf_norm - vGrad );\n\n	}\n\n#endif";
THREE.ShaderChunk.defaultnormal_vertex = "#ifdef USE_SKINNING\n\n	vec3 objectNormal = skinnedNormal.xyz;\n\n#elif defined( USE_MORPHNORMALS )\n\n	vec3 objectNormal = morphedNormal;\n\n#else\n\n	vec3 objectNormal = normal;\n\n#endif\n\n#ifdef FLIP_SIDED\n\n	objectNormal = -objectNormal;\n\n#endif\n\nvec3 transformedNormal = normalMatrix * objectNormal;\n";
THREE.ShaderChunk.lights_phong_pars_fragment = "uniform vec3 ambientLightColor;\n\n#if MAX_DIR_LIGHTS > 0\n\n	uniform vec3 directionalLightColor[ MAX_DIR_LIGHTS ];\n	uniform vec3 directionalLightDirection[ MAX_DIR_LIGHTS ];\n\n#endif\n\n#if MAX_HEMI_LIGHTS > 0\n\n	uniform vec3 hemisphereLightSkyColor[ MAX_HEMI_LIGHTS ];\n	uniform vec3 hemisphereLightGroundColor[ MAX_HEMI_LIGHTS ];\n	uniform vec3 hemisphereLightDirection[ MAX_HEMI_LIGHTS ];\n\n#endif\n\n#if MAX_POINT_LIGHTS > 0\n\n	uniform vec3 pointLightColor[ MAX_POINT_LIGHTS ];\n\n	uniform vec3 pointLightPosition[ MAX_POINT_LIGHTS ];\n	uniform float pointLightDistance[ MAX_POINT_LIGHTS ];\n\n#endif\n\n#if MAX_SPOT_LIGHTS > 0\n\n	uniform vec3 spotLightColor[ MAX_SPOT_LIGHTS ];\n	uniform vec3 spotLightPosition[ MAX_SPOT_LIGHTS ];\n	uniform vec3 spotLightDirection[ MAX_SPOT_LIGHTS ];\n	uniform float spotLightAngleCos[ MAX_SPOT_LIGHTS ];\n	uniform float spotLightExponent[ MAX_SPOT_LIGHTS ];\n\n	uniform float spotLightDistance[ MAX_SPOT_LIGHTS ];\n\n#endif\n\n#if MAX_SPOT_LIGHTS > 0 || defined( USE_BUMPMAP ) || defined( USE_ENVMAP )\n\n	varying vec3 vWorldPosition;\n\n#endif\n\n#ifdef WRAP_AROUND\n\n	uniform vec3 wrapRGB;\n\n#endif\n\nvarying vec3 vViewPosition;\nvarying vec3 vNormal;";
THREE.ShaderChunk.skinbase_vertex = "#ifdef USE_SKINNING\n\n	mat4 boneMatX = getBoneMatrix( skinIndex.x );\n	mat4 boneMatY = getBoneMatrix( skinIndex.y );\n	mat4 boneMatZ = getBoneMatrix( skinIndex.z );\n	mat4 boneMatW = getBoneMatrix( skinIndex.w );\n\n#endif";
THREE.ShaderChunk.map_vertex = "#if defined( USE_MAP ) || defined( USE_BUMPMAP ) || defined( USE_NORMALMAP ) || defined( USE_SPECULARMAP ) || defined( USE_ALPHAMAP )\n\n	vUv = uv * offsetRepeat.zw + offsetRepeat.xy;\n\n#endif";
THREE.ShaderChunk.lightmap_fragment = "#ifdef USE_LIGHTMAP\n\n	gl_FragColor = gl_FragColor * texture2D( lightMap, vUv2 );\n\n#endif";
THREE.ShaderChunk.shadowmap_pars_vertex = "#ifdef USE_SHADOWMAP\n\n	varying vec4 vShadowCoord[ MAX_SHADOWS ];\n	uniform mat4 shadowMatrix[ MAX_SHADOWS ];\n\n#endif";
THREE.ShaderChunk.color_fragment = "#ifdef USE_COLOR\n\n	gl_FragColor = gl_FragColor * vec4( vColor, 1.0 );\n\n#endif";
THREE.ShaderChunk.morphtarget_vertex = "#ifdef USE_MORPHTARGETS\n\n	vec3 morphed = vec3( 0.0 );\n	morphed += ( morphTarget0 - position ) * morphTargetInfluences[ 0 ];\n	morphed += ( morphTarget1 - position ) * morphTargetInfluences[ 1 ];\n	morphed += ( morphTarget2 - position ) * morphTargetInfluences[ 2 ];\n	morphed += ( morphTarget3 - position ) * morphTargetInfluences[ 3 ];\n\n	#ifndef USE_MORPHNORMALS\n\n	morphed += ( morphTarget4 - position ) * morphTargetInfluences[ 4 ];\n	morphed += ( morphTarget5 - position ) * morphTargetInfluences[ 5 ];\n	morphed += ( morphTarget6 - position ) * morphTargetInfluences[ 6 ];\n	morphed += ( morphTarget7 - position ) * morphTargetInfluences[ 7 ];\n\n	#endif\n\n	morphed += position;\n\n#endif";
THREE.ShaderChunk.envmap_vertex = "#if defined( USE_ENVMAP ) && ! defined( USE_BUMPMAP ) && ! defined( USE_NORMALMAP ) && ! defined( PHONG )\n\n	vec3 worldNormal = mat3( modelMatrix[ 0 ].xyz, modelMatrix[ 1 ].xyz, modelMatrix[ 2 ].xyz ) * objectNormal;\n	worldNormal = normalize( worldNormal );\n\n	vec3 cameraToVertex = normalize( worldPosition.xyz - cameraPosition );\n\n	#ifdef ENVMAP_MODE_REFLECTION\n\n		vReflect = reflect( cameraToVertex, worldNormal );\n\n	#else\n\n		vReflect = refract( cameraToVertex, worldNormal, refractionRatio );\n\n	#endif\n\n#endif\n";
THREE.ShaderChunk.shadowmap_fragment = "#ifdef USE_SHADOWMAP\n\n	#ifdef SHADOWMAP_DEBUG\n\n		vec3 frustumColors[3];\n		frustumColors[0] = vec3( 1.0, 0.5, 0.0 );\n		frustumColors[1] = vec3( 0.0, 1.0, 0.8 );\n		frustumColors[2] = vec3( 0.0, 0.5, 1.0 );\n\n	#endif\n\n	#ifdef SHADOWMAP_CASCADE\n\n		int inFrustumCount = 0;\n\n	#endif\n\n	float fDepth;\n	vec3 shadowColor = vec3( 1.0 );\n\n	for( int i = 0; i < MAX_SHADOWS; i ++ ) {\n\n		vec3 shadowCoord = vShadowCoord[ i ].xyz / vShadowCoord[ i ].w;\n\n				// if ( something && something ) breaks ATI OpenGL shader compiler\n				// if ( all( something, something ) ) using this instead\n\n		bvec4 inFrustumVec = bvec4 ( shadowCoord.x >= 0.0, shadowCoord.x <= 1.0, shadowCoord.y >= 0.0, shadowCoord.y <= 1.0 );\n		bool inFrustum = all( inFrustumVec );\n\n				// don't shadow pixels outside of light frustum\n				// use just first frustum (for cascades)\n				// don't shadow pixels behind far plane of light frustum\n\n		#ifdef SHADOWMAP_CASCADE\n\n			inFrustumCount += int( inFrustum );\n			bvec3 frustumTestVec = bvec3( inFrustum, inFrustumCount == 1, shadowCoord.z <= 1.0 );\n\n		#else\n\n			bvec2 frustumTestVec = bvec2( inFrustum, shadowCoord.z <= 1.0 );\n\n		#endif\n\n		bool frustumTest = all( frustumTestVec );\n\n		if ( frustumTest ) {\n\n			shadowCoord.z += shadowBias[ i ];\n\n			#if defined( SHADOWMAP_TYPE_PCF )\n\n						// Percentage-close filtering\n						// (9 pixel kernel)\n						// http://fabiensanglard.net/shadowmappingPCF/\n\n				float shadow = 0.0;\n\n		/*\n						// nested loops breaks shader compiler / validator on some ATI cards when using OpenGL\n						// must enroll loop manually\n\n				for ( float y = -1.25; y <= 1.25; y += 1.25 )\n					for ( float x = -1.25; x <= 1.25; x += 1.25 ) {\n\n						vec4 rgbaDepth = texture2D( shadowMap[ i ], vec2( x * xPixelOffset, y * yPixelOffset ) + shadowCoord.xy );\n\n								// doesn't seem to produce any noticeable visual difference compared to simple texture2D lookup\n								//vec4 rgbaDepth = texture2DProj( shadowMap[ i ], vec4( vShadowCoord[ i ].w * ( vec2( x * xPixelOffset, y * yPixelOffset ) + shadowCoord.xy ), 0.05, vShadowCoord[ i ].w ) );\n\n						float fDepth = unpackDepth( rgbaDepth );\n\n						if ( fDepth < shadowCoord.z )\n							shadow += 1.0;\n\n				}\n\n				shadow /= 9.0;\n\n		*/\n\n				const float shadowDelta = 1.0 / 9.0;\n\n				float xPixelOffset = 1.0 / shadowMapSize[ i ].x;\n				float yPixelOffset = 1.0 / shadowMapSize[ i ].y;\n\n				float dx0 = -1.25 * xPixelOffset;\n				float dy0 = -1.25 * yPixelOffset;\n				float dx1 = 1.25 * xPixelOffset;\n				float dy1 = 1.25 * yPixelOffset;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx0, dy0 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( 0.0, dy0 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx1, dy0 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx0, 0.0 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx1, 0.0 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx0, dy1 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( 0.0, dy1 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				fDepth = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx1, dy1 ) ) );\n				if ( fDepth < shadowCoord.z ) shadow += shadowDelta;\n\n				shadowColor = shadowColor * vec3( ( 1.0 - shadowDarkness[ i ] * shadow ) );\n\n			#elif defined( SHADOWMAP_TYPE_PCF_SOFT )\n\n						// Percentage-close filtering\n						// (9 pixel kernel)\n						// http://fabiensanglard.net/shadowmappingPCF/\n\n				float shadow = 0.0;\n\n				float xPixelOffset = 1.0 / shadowMapSize[ i ].x;\n				float yPixelOffset = 1.0 / shadowMapSize[ i ].y;\n\n				float dx0 = -1.0 * xPixelOffset;\n				float dy0 = -1.0 * yPixelOffset;\n				float dx1 = 1.0 * xPixelOffset;\n				float dy1 = 1.0 * yPixelOffset;\n\n				mat3 shadowKernel;\n				mat3 depthKernel;\n\n				depthKernel[0][0] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx0, dy0 ) ) );\n				depthKernel[0][1] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx0, 0.0 ) ) );\n				depthKernel[0][2] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx0, dy1 ) ) );\n				depthKernel[1][0] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( 0.0, dy0 ) ) );\n				depthKernel[1][1] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy ) );\n				depthKernel[1][2] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( 0.0, dy1 ) ) );\n				depthKernel[2][0] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx1, dy0 ) ) );\n				depthKernel[2][1] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx1, 0.0 ) ) );\n				depthKernel[2][2] = unpackDepth( texture2D( shadowMap[ i ], shadowCoord.xy + vec2( dx1, dy1 ) ) );\n\n				vec3 shadowZ = vec3( shadowCoord.z );\n				shadowKernel[0] = vec3(lessThan(depthKernel[0], shadowZ ));\n				shadowKernel[0] *= vec3(0.25);\n\n				shadowKernel[1] = vec3(lessThan(depthKernel[1], shadowZ ));\n				shadowKernel[1] *= vec3(0.25);\n\n				shadowKernel[2] = vec3(lessThan(depthKernel[2], shadowZ ));\n				shadowKernel[2] *= vec3(0.25);\n\n				vec2 fractionalCoord = 1.0 - fract( shadowCoord.xy * shadowMapSize[i].xy );\n\n				shadowKernel[0] = mix( shadowKernel[1], shadowKernel[0], fractionalCoord.x );\n				shadowKernel[1] = mix( shadowKernel[2], shadowKernel[1], fractionalCoord.x );\n\n				vec4 shadowValues;\n				shadowValues.x = mix( shadowKernel[0][1], shadowKernel[0][0], fractionalCoord.y );\n				shadowValues.y = mix( shadowKernel[0][2], shadowKernel[0][1], fractionalCoord.y );\n				shadowValues.z = mix( shadowKernel[1][1], shadowKernel[1][0], fractionalCoord.y );\n				shadowValues.w = mix( shadowKernel[1][2], shadowKernel[1][1], fractionalCoord.y );\n\n				shadow = dot( shadowValues, vec4( 1.0 ) );\n\n				shadowColor = shadowColor * vec3( ( 1.0 - shadowDarkness[ i ] * shadow ) );\n\n			#else\n\n				vec4 rgbaDepth = texture2D( shadowMap[ i ], shadowCoord.xy );\n				float fDepth = unpackDepth( rgbaDepth );\n\n				if ( fDepth < shadowCoord.z )\n\n		// spot with multiple shadows is darker\n\n					shadowColor = shadowColor * vec3( 1.0 - shadowDarkness[ i ] );\n\n		// spot with multiple shadows has the same color as single shadow spot\n\n		// 					shadowColor = min( shadowColor, vec3( shadowDarkness[ i ] ) );\n\n			#endif\n\n		}\n\n\n		#ifdef SHADOWMAP_DEBUG\n\n			#ifdef SHADOWMAP_CASCADE\n\n				if ( inFrustum && inFrustumCount == 1 ) gl_FragColor.xyz *= frustumColors[ i ];\n\n			#else\n\n				if ( inFrustum ) gl_FragColor.xyz *= frustumColors[ i ];\n\n			#endif\n\n		#endif\n\n	}\n\n	#ifdef GAMMA_OUTPUT\n\n		shadowColor *= shadowColor;\n\n	#endif\n\n	gl_FragColor.xyz = gl_FragColor.xyz * shadowColor;\n\n#endif\n";
THREE.ShaderChunk.worldpos_vertex = "#if defined( USE_ENVMAP ) || defined( PHONG ) || defined( LAMBERT ) || defined ( USE_SHADOWMAP )\n\n	#ifdef USE_SKINNING\n\n		vec4 worldPosition = modelMatrix * skinned;\n\n	#elif defined( USE_MORPHTARGETS )\n\n		vec4 worldPosition = modelMatrix * vec4( morphed, 1.0 );\n\n	#else\n\n		vec4 worldPosition = modelMatrix * vec4( position, 1.0 );\n\n	#endif\n\n#endif\n";
THREE.ShaderChunk.shadowmap_pars_fragment = "#ifdef USE_SHADOWMAP\n\n	uniform sampler2D shadowMap[ MAX_SHADOWS ];\n	uniform vec2 shadowMapSize[ MAX_SHADOWS ];\n\n	uniform float shadowDarkness[ MAX_SHADOWS ];\n	uniform float shadowBias[ MAX_SHADOWS ];\n\n	varying vec4 vShadowCoord[ MAX_SHADOWS ];\n\n	float unpackDepth( const in vec4 rgba_depth ) {\n\n		const vec4 bit_shift = vec4( 1.0 / ( 256.0 * 256.0 * 256.0 ), 1.0 / ( 256.0 * 256.0 ), 1.0 / 256.0, 1.0 );\n		float depth = dot( rgba_depth, bit_shift );\n		return depth;\n\n	}\n\n#endif";
THREE.ShaderChunk.skinning_pars_vertex = "#ifdef USE_SKINNING\n\n	uniform mat4 bindMatrix;\n	uniform mat4 bindMatrixInverse;\n\n	#ifdef BONE_TEXTURE\n\n		uniform sampler2D boneTexture;\n		uniform int boneTextureWidth;\n		uniform int boneTextureHeight;\n\n		mat4 getBoneMatrix( const in float i ) {\n\n			float j = i * 4.0;\n			float x = mod( j, float( boneTextureWidth ) );\n			float y = floor( j / float( boneTextureWidth ) );\n\n			float dx = 1.0 / float( boneTextureWidth );\n			float dy = 1.0 / float( boneTextureHeight );\n\n			y = dy * ( y + 0.5 );\n\n			vec4 v1 = texture2D( boneTexture, vec2( dx * ( x + 0.5 ), y ) );\n			vec4 v2 = texture2D( boneTexture, vec2( dx * ( x + 1.5 ), y ) );\n			vec4 v3 = texture2D( boneTexture, vec2( dx * ( x + 2.5 ), y ) );\n			vec4 v4 = texture2D( boneTexture, vec2( dx * ( x + 3.5 ), y ) );\n\n			mat4 bone = mat4( v1, v2, v3, v4 );\n\n			return bone;\n\n		}\n\n	#else\n\n		uniform mat4 boneGlobalMatrices[ MAX_BONES ];\n\n		mat4 getBoneMatrix( const in float i ) {\n\n			mat4 bone = boneGlobalMatrices[ int(i) ];\n			return bone;\n\n		}\n\n	#endif\n\n#endif\n";
THREE.ShaderChunk.logdepthbuf_pars_fragment = "#ifdef USE_LOGDEPTHBUF\n\n	uniform float logDepthBufFC;\n\n	#ifdef USE_LOGDEPTHBUF_EXT\n\n		#extension GL_EXT_frag_depth : enable\n		varying float vFragDepth;\n\n	#endif\n\n#endif";
THREE.ShaderChunk.alphamap_fragment = "#ifdef USE_ALPHAMAP\n\n	gl_FragColor.a *= texture2D( alphaMap, vUv ).g;\n\n#endif\n";
THREE.ShaderChunk.alphamap_pars_fragment = "#ifdef USE_ALPHAMAP\n\n	uniform sampler2D alphaMap;\n\n#endif\n";
THREE.UniformsUtils = {
    merge: function(b) {
        var a = {};
        for (var c = 0; c < b.length; c++) {
            var d = this.clone(b[c]);
            for (var e in d) {
                a[e] = d[e]
            }
        }
        return a
    },
    clone: function(a) {
        var c = {};
        for (var d in a) {
            c[d] = {};
            for (var e in a[d]) {
                var b = a[d][e];
                if (b instanceof THREE.Color || b instanceof THREE.Vector2 || b instanceof THREE.Vector3 || b instanceof THREE.Vector4 || b instanceof THREE.Matrix4 || b instanceof THREE.Texture) {
                    c[d][e] = b.clone()
                } else {
                    if (b instanceof Array) {
                        c[d][e] = b.slice()
                    } else {
                        c[d][e] = b
                    }
                }
            }
        }
        return c
    }
};
THREE.UniformsLib = {
    common: {
        diffuse: {
            type: "c",
            value: new THREE.Color(15658734)
        },
        opacity: {
            type: "f",
            value: 1
        },
        map: {
            type: "t",
            value: null
        },
        offsetRepeat: {
            type: "v4",
            value: new THREE.Vector4(0, 0, 1, 1)
        },
        lightMap: {
            type: "t",
            value: null
        },
        specularMap: {
            type: "t",
            value: null
        },
        alphaMap: {
            type: "t",
            value: null
        },
        envMap: {
            type: "t",
            value: null
        },
        flipEnvMap: {
            type: "f",
            value: -1
        },
        reflectivity: {
            type: "f",
            value: 1
        },
        refractionRatio: {
            type: "f",
            value: 0.98
        },
        morphTargetInfluences: {
            type: "f",
            value: 0
        }
    },
    bump: {
        bumpMap: {
            type: "t",
            value: null
        },
        bumpScale: {
            type: "f",
            value: 1
        }
    },
    normalmap: {
        normalMap: {
            type: "t",
            value: null
        },
        normalScale: {
            type: "v2",
            value: new THREE.Vector2(1, 1)
        }
    },
    fog: {
        fogDensity: {
            type: "f",
            value: 0.00025
        },
        fogNear: {
            type: "f",
            value: 1
        },
        fogFar: {
            type: "f",
            value: 2000
        },
        fogColor: {
            type: "c",
            value: new THREE.Color(16777215)
        }
    },
    lights: {
        ambientLightColor: {
            type: "fv",
            value: []
        },
        directionalLightDirection: {
            type: "fv",
            value: []
        },
        directionalLightColor: {
            type: "fv",
            value: []
        },
        hemisphereLightDirection: {
            type: "fv",
            value: []
        },
        hemisphereLightSkyColor: {
            type: "fv",
            value: []
        },
        hemisphereLightGroundColor: {
            type: "fv",
            value: []
        },
        pointLightColor: {
            type: "fv",
            value: []
        },
        pointLightPosition: {
            type: "fv",
            value: []
        },
        pointLightDistance: {
            type: "fv1",
            value: []
        },
        spotLightColor: {
            type: "fv",
            value: []
        },
        spotLightPosition: {
            type: "fv",
            value: []
        },
        spotLightDirection: {
            type: "fv",
            value: []
        },
        spotLightDistance: {
            type: "fv1",
            value: []
        },
        spotLightAngleCos: {
            type: "fv1",
            value: []
        },
        spotLightExponent: {
            type: "fv1",
            value: []
        }
    },
    particle: {
        psColor: {
            type: "c",
            value: new THREE.Color(15658734)
        },
        opacity: {
            type: "f",
            value: 1
        },
        size: {
            type: "f",
            value: 1
        },
        scale: {
            type: "f",
            value: 1
        },
        map: {
            type: "t",
            value: null
        },
        fogDensity: {
            type: "f",
            value: 0.00025
        },
        fogNear: {
            type: "f",
            value: 1
        },
        fogFar: {
            type: "f",
            value: 2000
        },
        fogColor: {
            type: "c",
            value: new THREE.Color(16777215)
        }
    },
    shadowmap: {
        shadowMap: {
            type: "tv",
            value: []
        },
        shadowMapSize: {
            type: "v2v",
            value: []
        },
        shadowBias: {
            type: "fv1",
            value: []
        },
        shadowDarkness: {
            type: "fv1",
            value: []
        },
        shadowMatrix: {
            type: "m4v",
            value: []
        }
    }
};
THREE.ShaderLib = {
    basic: {
        uniforms: THREE.UniformsUtils.merge([THREE.UniformsLib.common, THREE.UniformsLib.fog, THREE.UniformsLib.shadowmap]),
        vertexShader: [THREE.ShaderChunk.map_pars_vertex, THREE.ShaderChunk.lightmap_pars_vertex, THREE.ShaderChunk.envmap_pars_vertex, THREE.ShaderChunk.color_pars_vertex, THREE.ShaderChunk.morphtarget_pars_vertex, THREE.ShaderChunk.skinning_pars_vertex, THREE.ShaderChunk.shadowmap_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", THREE.ShaderChunk.map_vertex, THREE.ShaderChunk.lightmap_vertex, THREE.ShaderChunk.color_vertex, THREE.ShaderChunk.skinbase_vertex, "	#ifdef USE_ENVMAP", THREE.ShaderChunk.morphnormal_vertex, THREE.ShaderChunk.skinnormal_vertex, THREE.ShaderChunk.defaultnormal_vertex, "	#endif", THREE.ShaderChunk.morphtarget_vertex, THREE.ShaderChunk.skinning_vertex, THREE.ShaderChunk.default_vertex, THREE.ShaderChunk.logdepthbuf_vertex, THREE.ShaderChunk.worldpos_vertex, THREE.ShaderChunk.envmap_vertex, THREE.ShaderChunk.shadowmap_vertex, "}"].join("\n"),
        fragmentShader: ["uniform vec3 diffuse;", "uniform float opacity;", THREE.ShaderChunk.color_pars_fragment, THREE.ShaderChunk.map_pars_fragment, THREE.ShaderChunk.alphamap_pars_fragment, THREE.ShaderChunk.lightmap_pars_fragment, THREE.ShaderChunk.envmap_pars_fragment, THREE.ShaderChunk.fog_pars_fragment, THREE.ShaderChunk.shadowmap_pars_fragment, THREE.ShaderChunk.specularmap_pars_fragment, THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "	gl_FragColor = vec4( diffuse, opacity );", THREE.ShaderChunk.logdepthbuf_fragment, THREE.ShaderChunk.map_fragment, THREE.ShaderChunk.alphamap_fragment, THREE.ShaderChunk.alphatest_fragment, THREE.ShaderChunk.specularmap_fragment, THREE.ShaderChunk.lightmap_fragment, THREE.ShaderChunk.color_fragment, THREE.ShaderChunk.envmap_fragment, THREE.ShaderChunk.shadowmap_fragment, THREE.ShaderChunk.linear_to_gamma_fragment, THREE.ShaderChunk.fog_fragment, "}"].join("\n")
    },
    lambert: {
        uniforms: THREE.UniformsUtils.merge([THREE.UniformsLib.common, THREE.UniformsLib.fog, THREE.UniformsLib.lights, THREE.UniformsLib.shadowmap, {
            ambient: {
                type: "c",
                value: new THREE.Color(16777215)
            },
            emissive: {
                type: "c",
                value: new THREE.Color(0)
            },
            wrapRGB: {
                type: "v3",
                value: new THREE.Vector3(1, 1, 1)
            }
        }]),
        vertexShader: ["#define LAMBERT", "varying vec3 vLightFront;", "#ifdef DOUBLE_SIDED", "	varying vec3 vLightBack;", "#endif", THREE.ShaderChunk.map_pars_vertex, THREE.ShaderChunk.lightmap_pars_vertex, THREE.ShaderChunk.envmap_pars_vertex, THREE.ShaderChunk.lights_lambert_pars_vertex, THREE.ShaderChunk.color_pars_vertex, THREE.ShaderChunk.morphtarget_pars_vertex, THREE.ShaderChunk.skinning_pars_vertex, THREE.ShaderChunk.shadowmap_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", THREE.ShaderChunk.map_vertex, THREE.ShaderChunk.lightmap_vertex, THREE.ShaderChunk.color_vertex, THREE.ShaderChunk.morphnormal_vertex, THREE.ShaderChunk.skinbase_vertex, THREE.ShaderChunk.skinnormal_vertex, THREE.ShaderChunk.defaultnormal_vertex, THREE.ShaderChunk.morphtarget_vertex, THREE.ShaderChunk.skinning_vertex, THREE.ShaderChunk.default_vertex, THREE.ShaderChunk.logdepthbuf_vertex, THREE.ShaderChunk.worldpos_vertex, THREE.ShaderChunk.envmap_vertex, THREE.ShaderChunk.lights_lambert_vertex, THREE.ShaderChunk.shadowmap_vertex, "}"].join("\n"),
        fragmentShader: ["uniform float opacity;", "varying vec3 vLightFront;", "#ifdef DOUBLE_SIDED", "	varying vec3 vLightBack;", "#endif", THREE.ShaderChunk.color_pars_fragment, THREE.ShaderChunk.map_pars_fragment, THREE.ShaderChunk.alphamap_pars_fragment, THREE.ShaderChunk.lightmap_pars_fragment, THREE.ShaderChunk.envmap_pars_fragment, THREE.ShaderChunk.fog_pars_fragment, THREE.ShaderChunk.shadowmap_pars_fragment, THREE.ShaderChunk.specularmap_pars_fragment, THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "	gl_FragColor = vec4( vec3( 1.0 ), opacity );", THREE.ShaderChunk.logdepthbuf_fragment, THREE.ShaderChunk.map_fragment, THREE.ShaderChunk.alphamap_fragment, THREE.ShaderChunk.alphatest_fragment, THREE.ShaderChunk.specularmap_fragment, "	#ifdef DOUBLE_SIDED", "		if ( gl_FrontFacing )", "			gl_FragColor.xyz *= vLightFront;", "		else", "			gl_FragColor.xyz *= vLightBack;", "	#else", "		gl_FragColor.xyz *= vLightFront;", "	#endif", THREE.ShaderChunk.lightmap_fragment, THREE.ShaderChunk.color_fragment, THREE.ShaderChunk.envmap_fragment, THREE.ShaderChunk.shadowmap_fragment, THREE.ShaderChunk.linear_to_gamma_fragment, THREE.ShaderChunk.fog_fragment, "}"].join("\n")
    },
    phong: {
        uniforms: THREE.UniformsUtils.merge([THREE.UniformsLib.common, THREE.UniformsLib.bump, THREE.UniformsLib.normalmap, THREE.UniformsLib.fog, THREE.UniformsLib.lights, THREE.UniformsLib.shadowmap, {
            ambient: {
                type: "c",
                value: new THREE.Color(16777215)
            },
            emissive: {
                type: "c",
                value: new THREE.Color(0)
            },
            specular: {
                type: "c",
                value: new THREE.Color(1118481)
            },
            shininess: {
                type: "f",
                value: 30
            },
            wrapRGB: {
                type: "v3",
                value: new THREE.Vector3(1, 1, 1)
            }
        }]),
        vertexShader: ["#define PHONG", "varying vec3 vViewPosition;", "varying vec3 vNormal;", THREE.ShaderChunk.map_pars_vertex, THREE.ShaderChunk.lightmap_pars_vertex, THREE.ShaderChunk.envmap_pars_vertex, THREE.ShaderChunk.lights_phong_pars_vertex, THREE.ShaderChunk.color_pars_vertex, THREE.ShaderChunk.morphtarget_pars_vertex, THREE.ShaderChunk.skinning_pars_vertex, THREE.ShaderChunk.shadowmap_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", THREE.ShaderChunk.map_vertex, THREE.ShaderChunk.lightmap_vertex, THREE.ShaderChunk.color_vertex, THREE.ShaderChunk.morphnormal_vertex, THREE.ShaderChunk.skinbase_vertex, THREE.ShaderChunk.skinnormal_vertex, THREE.ShaderChunk.defaultnormal_vertex, "	vNormal = normalize( transformedNormal );", THREE.ShaderChunk.morphtarget_vertex, THREE.ShaderChunk.skinning_vertex, THREE.ShaderChunk.default_vertex, THREE.ShaderChunk.logdepthbuf_vertex, "	vViewPosition = -mvPosition.xyz;", THREE.ShaderChunk.worldpos_vertex, THREE.ShaderChunk.envmap_vertex, THREE.ShaderChunk.lights_phong_vertex, THREE.ShaderChunk.shadowmap_vertex, "}"].join("\n"),
        fragmentShader: ["#define PHONG", "uniform vec3 diffuse;", "uniform float opacity;", "uniform vec3 ambient;", "uniform vec3 emissive;", "uniform vec3 specular;", "uniform float shininess;", THREE.ShaderChunk.color_pars_fragment, THREE.ShaderChunk.map_pars_fragment, THREE.ShaderChunk.alphamap_pars_fragment, THREE.ShaderChunk.lightmap_pars_fragment, THREE.ShaderChunk.envmap_pars_fragment, THREE.ShaderChunk.fog_pars_fragment, THREE.ShaderChunk.lights_phong_pars_fragment, THREE.ShaderChunk.shadowmap_pars_fragment, THREE.ShaderChunk.bumpmap_pars_fragment, THREE.ShaderChunk.normalmap_pars_fragment, THREE.ShaderChunk.specularmap_pars_fragment, THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "	gl_FragColor = vec4( vec3( 1.0 ), opacity );", THREE.ShaderChunk.logdepthbuf_fragment, THREE.ShaderChunk.map_fragment, THREE.ShaderChunk.alphamap_fragment, THREE.ShaderChunk.alphatest_fragment, THREE.ShaderChunk.specularmap_fragment, THREE.ShaderChunk.lights_phong_fragment, THREE.ShaderChunk.lightmap_fragment, THREE.ShaderChunk.color_fragment, THREE.ShaderChunk.envmap_fragment, THREE.ShaderChunk.shadowmap_fragment, THREE.ShaderChunk.linear_to_gamma_fragment, THREE.ShaderChunk.fog_fragment, "}"].join("\n")
    },
    particle_basic: {
        uniforms: THREE.UniformsUtils.merge([THREE.UniformsLib.particle, THREE.UniformsLib.shadowmap]),
        vertexShader: ["uniform float size;", "uniform float scale;", THREE.ShaderChunk.color_pars_vertex, THREE.ShaderChunk.shadowmap_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", THREE.ShaderChunk.color_vertex, "	vec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );", "	#ifdef USE_SIZEATTENUATION", "		gl_PointSize = size * ( scale / length( mvPosition.xyz ) );", "	#else", "		gl_PointSize = size;", "	#endif", "	gl_Position = projectionMatrix * mvPosition;", THREE.ShaderChunk.logdepthbuf_vertex, THREE.ShaderChunk.worldpos_vertex, THREE.ShaderChunk.shadowmap_vertex, "}"].join("\n"),
        fragmentShader: ["uniform vec3 psColor;", "uniform float opacity;", THREE.ShaderChunk.color_pars_fragment, THREE.ShaderChunk.map_particle_pars_fragment, THREE.ShaderChunk.fog_pars_fragment, THREE.ShaderChunk.shadowmap_pars_fragment, THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "	gl_FragColor = vec4( psColor, opacity );", THREE.ShaderChunk.logdepthbuf_fragment, THREE.ShaderChunk.map_particle_fragment, THREE.ShaderChunk.alphatest_fragment, THREE.ShaderChunk.color_fragment, THREE.ShaderChunk.shadowmap_fragment, THREE.ShaderChunk.fog_fragment, "}"].join("\n")
    },
    dashed: {
        uniforms: THREE.UniformsUtils.merge([THREE.UniformsLib.common, THREE.UniformsLib.fog, {
            scale: {
                type: "f",
                value: 1
            },
            dashSize: {
                type: "f",
                value: 1
            },
            totalSize: {
                type: "f",
                value: 2
            }
        }]),
        vertexShader: ["uniform float scale;", "attribute float lineDistance;", "varying float vLineDistance;", THREE.ShaderChunk.color_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", THREE.ShaderChunk.color_vertex, "	vLineDistance = scale * lineDistance;", "	vec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );", "	gl_Position = projectionMatrix * mvPosition;", THREE.ShaderChunk.logdepthbuf_vertex, "}"].join("\n"),
        fragmentShader: ["uniform vec3 diffuse;", "uniform float opacity;", "uniform float dashSize;", "uniform float totalSize;", "varying float vLineDistance;", THREE.ShaderChunk.color_pars_fragment, THREE.ShaderChunk.fog_pars_fragment, THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "	if ( mod( vLineDistance, totalSize ) > dashSize ) {", "		discard;", "	}", "	gl_FragColor = vec4( diffuse, opacity );", THREE.ShaderChunk.logdepthbuf_fragment, THREE.ShaderChunk.color_fragment, THREE.ShaderChunk.fog_fragment, "}"].join("\n")
    },
    depth: {
        uniforms: {
            mNear: {
                type: "f",
                value: 1
            },
            mFar: {
                type: "f",
                value: 2000
            },
            opacity: {
                type: "f",
                value: 1
            }
        },
        vertexShader: [THREE.ShaderChunk.morphtarget_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", THREE.ShaderChunk.morphtarget_vertex, THREE.ShaderChunk.default_vertex, THREE.ShaderChunk.logdepthbuf_vertex, "}"].join("\n"),
        fragmentShader: ["uniform float mNear;", "uniform float mFar;", "uniform float opacity;", THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", THREE.ShaderChunk.logdepthbuf_fragment, "	#ifdef USE_LOGDEPTHBUF_EXT", "		float depth = gl_FragDepthEXT / gl_FragCoord.w;", "	#else", "		float depth = gl_FragCoord.z / gl_FragCoord.w;", "	#endif", "	float color = 1.0 - smoothstep( mNear, mFar, depth );", "	gl_FragColor = vec4( vec3( color ), opacity );", "}"].join("\n")
    },
    normal: {
        uniforms: {
            opacity: {
                type: "f",
                value: 1
            }
        },
        vertexShader: ["varying vec3 vNormal;", THREE.ShaderChunk.morphtarget_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", "	vNormal = normalize( normalMatrix * normal );", THREE.ShaderChunk.morphtarget_vertex, THREE.ShaderChunk.default_vertex, THREE.ShaderChunk.logdepthbuf_vertex, "}"].join("\n"),
        fragmentShader: ["uniform float opacity;", "varying vec3 vNormal;", THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "	gl_FragColor = vec4( 0.5 * normalize( vNormal ) + 0.5, opacity );", THREE.ShaderChunk.logdepthbuf_fragment, "}"].join("\n")
    },
    cube: {
        uniforms: {
            tCube: {
                type: "t",
                value: null
            },
            tFlip: {
                type: "f",
                value: -1
            }
        },
        vertexShader: ["varying vec3 vWorldPosition;", THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", "	vec4 worldPosition = modelMatrix * vec4( position, 1.0 );", "	vWorldPosition = worldPosition.xyz;", "	gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );", THREE.ShaderChunk.logdepthbuf_vertex, "}"].join("\n"),
        fragmentShader: ["uniform samplerCube tCube;", "uniform float tFlip;", "varying vec3 vWorldPosition;", THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "	gl_FragColor = textureCube( tCube, vec3( tFlip * vWorldPosition.x, vWorldPosition.yz ) );", THREE.ShaderChunk.logdepthbuf_fragment, "}"].join("\n")
    },
    equirect: {
        uniforms: {
            tEquirect: {
                type: "t",
                value: null
            },
            tFlip: {
                type: "f",
                value: -1
            }
        },
        vertexShader: ["varying vec3 vWorldPosition;", THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", "	vec4 worldPosition = modelMatrix * vec4( position, 1.0 );", "	vWorldPosition = worldPosition.xyz;", "	gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );", THREE.ShaderChunk.logdepthbuf_vertex, "}"].join("\n"),
        fragmentShader: ["uniform sampler2D tEquirect;", "uniform float tFlip;", "varying vec3 vWorldPosition;", THREE.ShaderChunk.logdepthbuf_pars_fragment, "void main() {", "vec3 direction = normalize( vWorldPosition );", "vec2 sampleUV;", "sampleUV.y = clamp( tFlip * direction.y * -0.5 + 0.5, 0.0, 1.0);", "sampleUV.x = atan( direction.z, direction.x ) * 0.15915494309189533576888376337251 + 0.5;", "gl_FragColor = texture2D( tEquirect, sampleUV );", THREE.ShaderChunk.logdepthbuf_fragment, "}"].join("\n")
    },
    depthRGBA: {
        uniforms: {},
        vertexShader: [THREE.ShaderChunk.morphtarget_pars_vertex, THREE.ShaderChunk.skinning_pars_vertex, THREE.ShaderChunk.logdepthbuf_pars_vertex, "void main() {", THREE.ShaderChunk.skinbase_vertex, THREE.ShaderChunk.morphtarget_vertex, THREE.ShaderChunk.skinning_vertex, THREE.ShaderChunk.default_vertex, THREE.ShaderChunk.logdepthbuf_vertex, "}"].join("\n"),
        fragmentShader: [THREE.ShaderChunk.logdepthbuf_pars_fragment, "vec4 pack_depth( const in float depth ) {", "	const vec4 bit_shift = vec4( 256.0 * 256.0 * 256.0, 256.0 * 256.0, 256.0, 1.0 );", "	const vec4 bit_mask = vec4( 0.0, 1.0 / 256.0, 1.0 / 256.0, 1.0 / 256.0 );", "	vec4 res = mod( depth * bit_shift * vec4( 255 ), vec4( 256 ) ) / vec4( 255 );", "	res -= res.xxyz * bit_mask;", "	return res;", "}", "void main() {", THREE.ShaderChunk.logdepthbuf_fragment, "	#ifdef USE_LOGDEPTHBUF_EXT", "		gl_FragData[ 0 ] = pack_depth( gl_FragDepthEXT );", "	#else", "		gl_FragData[ 0 ] = pack_depth( gl_FragCoord.z );", "	#endif", "}"].join("\n")
    }
};
THREE.WebGLRenderer = function(aJ) {
    aJ = aJ || {};
    var aU = aJ.canvas !== undefined ? aJ.canvas : document.createElement("canvas"),
        aT = aJ.context !== undefined ? aJ.context : null,
        n = 1,
        i = aJ.precision !== undefined ? aJ.precision : "highp",
        bx = aJ.alpha !== undefined ? aJ.alpha : false,
        aw = aJ.depth !== undefined ? aJ.depth : true,
        e = aJ.stencil !== undefined ? aJ.stencil : true,
        bY = aJ.antialias !== undefined ? aJ.antialias : false,
        aX = aJ.premultipliedAlpha !== undefined ? aJ.premultipliedAlpha : true,
        W = aJ.preserveDrawingBuffer !== undefined ? aJ.preserveDrawingBuffer : false,
        t = aJ.logarithmicDepthBuffer !== undefined ? aJ.logarithmicDepthBuffer : false,
        bq = new THREE.Color(0),
        V = 0;
    var bI = [];
    var s = {};
    var o = [];
    var bv = [];
    var A = [];
    var ad = [];
    var Q = [];
    this.domElement = aU;
    this.context = null;
    this.autoClear = true;
    this.autoClearColor = true;
    this.autoClearDepth = true;
    this.autoClearStencil = true;
    this.sortObjects = true;
    this.gammaInput = false;
    this.gammaOutput = false;
    this.shadowMapEnabled = false;
    this.shadowMapType = THREE.PCFShadowMap;
    this.shadowMapCullFace = THREE.CullFaceFront;
    this.shadowMapDebug = false;
    this.shadowMapCascade = false;
    this.maxMorphTargets = 8;
    this.maxMorphNormals = 4;
    this.autoScaleCubemaps = true;
    this.info = {
        memory: {
            programs: 0,
            geometries: 0,
            textures: 0
        },
        render: {
            calls: 0,
            vertices: 0,
            faces: 0,
            points: 0
        }
    };
    var aK = this,
        by = [],
        al = null,
        bA = null,
        aZ = -1,
        aA = "",
        aH = null,
        bb = 0,
        bi = -1,
        j = -1,
        h = -1,
        ai = -1,
        bO = -1,
        ar = -1,
        a = -1,
        bu = -1,
        aF = null,
        bL = null,
        a8 = null,
        bm = null,
        a1 = 0,
        a0 = 0,
        bQ = aU.width,
        aQ = aU.height,
        D = 0,
        aP = 0,
        ao = new Uint8Array(16),
        M = new Uint8Array(16),
        br = new THREE.Frustum(),
        aW = new THREE.Matrix4(),
        F = new THREE.Matrix4(),
        U = new THREE.Vector3(),
        aI = new THREE.Vector3(),
        bZ = true,
        bp = {
            ambient: [0, 0, 0],
            directional: {
                length: 0,
                colors: [],
                positions: []
            },
            point: {
                length: 0,
                colors: [],
                positions: [],
                distances: []
            },
            spot: {
                length: 0,
                colors: [],
                positions: [],
                distances: [],
                directions: [],
                anglesCos: [],
                exponents: []
            },
            hemi: {
                length: 0,
                skyColors: [],
                groundColors: [],
                positions: []
            }
        };
    var c;
    try {
        var bT = {
            alpha: bx,
            depth: aw,
            stencil: e,
            antialias: bY,
            premultipliedAlpha: aX,
            preserveDrawingBuffer: W
        };
        c = aT || aU.getContext("webgl", bT) || aU.getContext("experimental-webgl", bT);
        if (c === null) {
            if (aU.getContext("webgl") !== null) {
                throw "Error creating WebGL context with your selected attributes."
            } else {
                throw "Error creating WebGL context."
            }
        }
        aU.addEventListener("webglcontextlost", function(b0) {
            b0.preventDefault();
            bS();
            ba();
            s = {}
        }, false)
    } catch (bH) {
        console.error(bH)
    }
    if (c.getShaderPrecisionFormat === undefined) {
        c.getShaderPrecisionFormat = function() {
            return {
                rangeMin: 1,
                rangeMax: 1,
                precision: 1
            }
        }
    }
    var a2 = new THREE.WebGLExtensions(c);
    a2.get("OES_texture_float");
    a2.get("OES_texture_float_linear");
    a2.get("OES_standard_derivatives");
    if (t) {
        a2.get("EXT_frag_depth")
    }
    var ba = function() {
        c.clearColor(0, 0, 0, 1);
        c.clearDepth(1);
        c.clearStencil(0);
        c.enable(c.DEPTH_TEST);
        c.depthFunc(c.LEQUAL);
        c.frontFace(c.CCW);
        c.cullFace(c.BACK);
        c.enable(c.CULL_FACE);
        c.enable(c.BLEND);
        c.blendEquation(c.FUNC_ADD);
        c.blendFunc(c.SRC_ALPHA, c.ONE_MINUS_SRC_ALPHA);
        c.viewport(a1, a0, bQ, aQ);
        c.clearColor(bq.r, bq.g, bq.b, V)
    };
    var bS = function() {
        al = null;
        aH = null;
        h = -1;
        a = -1;
        bu = -1;
        bi = -1;
        j = -1;
        aA = "";
        aZ = -1;
        bZ = true;
        for (var b0 = 0; b0 < M.length; b0++) {
            M[b0] = 0
        }
    };
    ba();
    this.context = c;
    var bE = c.getParameter(c.MAX_TEXTURE_IMAGE_UNITS);
    var b = c.getParameter(c.MAX_VERTEX_TEXTURE_IMAGE_UNITS);
    var B = c.getParameter(c.MAX_TEXTURE_SIZE);
    var an = c.getParameter(c.MAX_CUBE_MAP_TEXTURE_SIZE);
    var aR = b > 0;
    var Z = aR && a2.get("OES_texture_float");
    var bt = c.getShaderPrecisionFormat(c.VERTEX_SHADER, c.HIGH_FLOAT);
    var bP = c.getShaderPrecisionFormat(c.VERTEX_SHADER, c.MEDIUM_FLOAT);
    var bJ = c.getShaderPrecisionFormat(c.VERTEX_SHADER, c.LOW_FLOAT);
    var am = c.getShaderPrecisionFormat(c.FRAGMENT_SHADER, c.HIGH_FLOAT);
    var bz = c.getShaderPrecisionFormat(c.FRAGMENT_SHADER, c.MEDIUM_FLOAT);
    var ax = c.getShaderPrecisionFormat(c.FRAGMENT_SHADER, c.LOW_FLOAT);
    var X = (function() {
        var b0;
        return function() {
            if (b0 !== undefined) {
                return b0
            }
            b0 = [];
            if (a2.get("WEBGL_compressed_texture_pvrtc") || a2.get("WEBGL_compressed_texture_s3tc")) {
                var b1 = c.getParameter(c.COMPRESSED_TEXTURE_FORMATS);
                for (var b2 = 0; b2 < b1.length; b2++) {
                    b0.push(b1[b2])
                }
            }
            return b0
        }
    })();
    var bR = bt.precision > 0 && am.precision > 0;
    var bg = bP.precision > 0 && bz.precision > 0;
    if (i === "highp" && !bR) {
        if (bg) {
            i = "mediump";
            console.warn("THREE.WebGLRenderer: highp not supported, using mediump.")
        } else {
            i = "lowp";
            console.warn("THREE.WebGLRenderer: highp and mediump not supported, using lowp.")
        }
    }
    if (i === "mediump" && !bg) {
        i = "lowp";
        console.warn("THREE.WebGLRenderer: mediump not supported, using lowp.")
    }
    var l = new THREE.ShadowMapPlugin(this, bI, s, o);
    var be = new THREE.SpritePlugin(this, ad);
    var bK = new THREE.LensFlarePlugin(this, Q);
    this.getContext = function() {
        return c
    };
    this.forceContextLoss = function() {
        a2.get("WEBGL_lose_context").loseContext()
    };
    this.supportsVertexTextures = function() {
        return aR
    };
    this.supportsFloatTextures = function() {
        return a2.get("OES_texture_float")
    };
    this.supportsStandardDerivatives = function() {
        return a2.get("OES_standard_derivatives")
    };
    this.supportsCompressedTextureS3TC = function() {
        return a2.get("WEBGL_compressed_texture_s3tc")
    };
    this.supportsCompressedTexturePVRTC = function() {
        return a2.get("WEBGL_compressed_texture_pvrtc")
    };
    this.supportsBlendMinMax = function() {
        return a2.get("EXT_blend_minmax")
    };
    this.getMaxAnisotropy = (function() {
        var b0;
        return function() {
            if (b0 !== undefined) {
                return b0
            }
            var b1 = a2.get("EXT_texture_filter_anisotropic");
            b0 = b1 !== null ? c.getParameter(b1.MAX_TEXTURE_MAX_ANISOTROPY_EXT) : 0;
            return b0
        }
    })();
    this.getPrecision = function() {
        return i
    };
    this.getPixelRatio = function() {
        return n
    };
    this.setPixelRatio = function(b0) {
        n = b0
    };
    this.setSize = function(b1, b0, b2) {
        aU.width = b1 * n;
        aU.height = b0 * n;
        if (b2 !== false) {
            aU.style.width = b1 + "px";
            aU.style.height = b0 + "px"
        }
        this.setViewport(0, 0, b1, b0)
    };
    this.setViewport = function(b1, b3, b2, b0) {
        a1 = b1 * n;
        a0 = b3 * n;
        bQ = b2 * n;
        aQ = b0 * n;
        c.viewport(a1, a0, bQ, aQ)
    };
    this.setScissor = function(b1, b3, b2, b0) {
        c.scissor(b1 * n, b3 * n, b2 * n, b0 * n)
    };
    this.enableScissorTest = function(b0) {
        b0 ? c.enable(c.SCISSOR_TEST) : c.disable(c.SCISSOR_TEST)
    };
    this.getClearColor = function() {
        return bq
    };
    this.setClearColor = function(b0, b1) {
        bq.set(b0);
        V = b1 !== undefined ? b1 : 1;
        c.clearColor(bq.r, bq.g, bq.b, V)
    };
    this.getClearAlpha = function() {
        return V
    };
    this.setClearAlpha = function(b0) {
        V = b0;
        c.clearColor(bq.r, bq.g, bq.b, V)
    };
    this.clear = function(b0, b3, b1) {
        var b2 = 0;
        if (b0 === undefined || b0) {
            b2 |= c.COLOR_BUFFER_BIT
        }
        if (b3 === undefined || b3) {
            b2 |= c.DEPTH_BUFFER_BIT
        }
        if (b1 === undefined || b1) {
            b2 |= c.STENCIL_BUFFER_BIT
        }
        c.clear(b2)
    };
    this.clearColor = function() {
        c.clear(c.COLOR_BUFFER_BIT)
    };
    this.clearDepth = function() {
        c.clear(c.DEPTH_BUFFER_BIT)
    };
    this.clearStencil = function() {
        c.clear(c.STENCIL_BUFFER_BIT)
    };
    this.clearTarget = function(b2, b0, b3, b1) {
        this.setRenderTarget(b2);
        this.clear(b0, b3, b1)
    };
    this.resetGLState = bS;

    function G(b0) {
        b0.__webglVertexBuffer = c.createBuffer();
        b0.__webglColorBuffer = c.createBuffer();
        aK.info.memory.geometries++
    }

    function ae(b0) {
        b0.__webglVertexBuffer = c.createBuffer();
        b0.__webglColorBuffer = c.createBuffer();
        b0.__webglLineDistanceBuffer = c.createBuffer();
        aK.info.memory.geometries++
    }

    function aB(b1) {
        b1.__webglVertexBuffer = c.createBuffer();
        b1.__webglNormalBuffer = c.createBuffer();
        b1.__webglTangentBuffer = c.createBuffer();
        b1.__webglColorBuffer = c.createBuffer();
        b1.__webglUVBuffer = c.createBuffer();
        b1.__webglUV2Buffer = c.createBuffer();
        b1.__webglSkinIndicesBuffer = c.createBuffer();
        b1.__webglSkinWeightsBuffer = c.createBuffer();
        b1.__webglFaceBuffer = c.createBuffer();
        b1.__webglLineBuffer = c.createBuffer();
        var b4 = b1.numMorphTargets;
        if (b4) {
            b1.__webglMorphTargetsBuffers = [];
            for (var b0 = 0, b3 = b4; b0 < b3; b0++) {
                b1.__webglMorphTargetsBuffers.push(c.createBuffer())
            }
        }
        var b2 = b1.numMorphNormals;
        if (b2) {
            b1.__webglMorphNormalsBuffers = [];
            for (var b0 = 0, b3 = b2; b0 < b3; b0++) {
                b1.__webglMorphNormalsBuffers.push(c.createBuffer())
            }
        }
        aK.info.memory.geometries++
    }
    var bN = function(b1) {
        var b0 = b1.target;
        b0.traverse(function(b2) {
            b2.removeEventListener("remove", bN);
            N(b2)
        })
    };
    var aV = function(b0) {
        var b1 = b0.target;
        b1.removeEventListener("dispose", aV);
        bU(b1)
    };
    var ag = function(b1) {
        var b0 = b1.target;
        b0.removeEventListener("dispose", ag);
        I(b0);
        aK.info.memory.textures--
    };
    var S = function(b0) {
        var b1 = b0.target;
        b1.removeEventListener("dispose", S);
        ay(b1);
        aK.info.memory.textures--
    };
    var bf = function(b1) {
        var b0 = b1.target;
        b0.removeEventListener("dispose", bf);
        R(b0)
    };
    var m = function(b4) {
        var b1 = ["__webglVertexBuffer", "__webglNormalBuffer", "__webglTangentBuffer", "__webglColorBuffer", "__webglUVBuffer", "__webglUV2Buffer", "__webglSkinIndicesBuffer", "__webglSkinWeightsBuffer", "__webglFaceBuffer", "__webglLineBuffer", "__webglLineDistanceBuffer"];
        for (var b3 = 0, b0 = b1.length; b3 < b0; b3++) {
            var b2 = b1[b3];
            if (b4[b2] !== undefined) {
                c.deleteBuffer(b4[b2]);
                delete b4[b2]
            }
        }
        if (b4.__webglCustomAttributesList !== undefined) {
            for (var b2 in b4.__webglCustomAttributesList) {
                c.deleteBuffer(b4.__webglCustomAttributesList[b2].buffer)
            }
            delete b4.__webglCustomAttributesList
        }
        aK.info.memory.geometries--
    };
    var bU = function(b8) {
        delete b8.__webglInit;
        if (b8 instanceof THREE.BufferGeometry) {
            for (var b0 in b8.attributes) {
                var b1 = b8.attributes[b0];
                if (b1.buffer !== undefined) {
                    c.deleteBuffer(b1.buffer);
                    delete b1.buffer
                }
            }
            aK.info.memory.geometries--
        } else {
            var b7 = C[b8.id];
            if (b7 !== undefined) {
                for (var b6 = 0, b3 = b7.length; b6 < b3; b6++) {
                    var b4 = b7[b6];
                    if (b4.numMorphTargets !== undefined) {
                        for (var b2 = 0, b5 = b4.numMorphTargets; b2 < b5; b2++) {
                            c.deleteBuffer(b4.__webglMorphTargetsBuffers[b2])
                        }
                        delete b4.__webglMorphTargetsBuffers
                    }
                    if (b4.numMorphNormals !== undefined) {
                        for (var b2 = 0, b5 = b4.numMorphNormals; b2 < b5; b2++) {
                            c.deleteBuffer(b4.__webglMorphNormalsBuffers[b2])
                        }
                        delete b4.__webglMorphNormalsBuffers
                    }
                    m(b4)
                }
                delete C[b8.id]
            } else {
                m(b8)
            }
        }
        aA = ""
    };
    var I = function(b0) {
        if (b0.image && b0.image.__webglTextureCube) {
            c.deleteTexture(b0.image.__webglTextureCube);
            delete b0.image.__webglTextureCube
        } else {
            if (b0.__webglInit === undefined) {
                return
            }
            c.deleteTexture(b0.__webglTexture);
            delete b0.__webglTexture;
            delete b0.__webglInit
        }
    };
    var ay = function(b1) {
        if (!b1 || b1.__webglTexture === undefined) {
            return
        }
        c.deleteTexture(b1.__webglTexture);
        delete b1.__webglTexture;
        if (b1 instanceof THREE.WebGLRenderTargetCube) {
            for (var b0 = 0; b0 < 6; b0++) {
                c.deleteFramebuffer(b1.__webglFramebuffer[b0]);
                c.deleteRenderbuffer(b1.__webglRenderbuffer[b0])
            }
        } else {
            c.deleteFramebuffer(b1.__webglFramebuffer);
            c.deleteRenderbuffer(b1.__webglRenderbuffer)
        }
        delete b1.__webglFramebuffer;
        delete b1.__webglRenderbuffer
    };
    var R = function(b6) {
        var b2 = b6.program.program;
        if (b2 === undefined) {
            return
        }
        b6.program = undefined;
        var b3, b1, b5;
        var b4 = false;
        for (b3 = 0, b1 = by.length; b3 < b1; b3++) {
            b5 = by[b3];
            if (b5.program === b2) {
                b5.usedTimes--;
                if (b5.usedTimes === 0) {
                    b4 = true
                }
                break
            }
        }
        if (b4 === true) {
            var b0 = [];
            for (b3 = 0, b1 = by.length; b3 < b1; b3++) {
                b5 = by[b3];
                if (b5.program !== b2) {
                    b0.push(b5)
                }
            }
            by = b0;
            c.deleteProgram(b2);
            aK.info.memory.programs--
        }
    };

    function bV(b1) {
        var b6 = b1.geometry;
        var b4 = b1.material;
        var b3 = b6.vertices.length;
        if (b4.attributes) {
            if (b6.__webglCustomAttributesList === undefined) {
                b6.__webglCustomAttributesList = []
            }
            for (var b0 in b4.attributes) {
                var b5 = b4.attributes[b0];
                if (!b5.__webglInitialized || b5.createUniqueBuffers) {
                    b5.__webglInitialized = true;
                    var b2 = 1;
                    if (b5.type === "v2") {
                        b2 = 2
                    } else {
                        if (b5.type === "v3") {
                            b2 = 3
                        } else {
                            if (b5.type === "v4") {
                                b2 = 4
                            } else {
                                if (b5.type === "c") {
                                    b2 = 3
                                }
                            }
                        }
                    }
                    b5.size = b2;
                    b5.array = new Float32Array(b3 * b2);
                    b5.buffer = c.createBuffer();
                    b5.buffer.belongsToAttribute = b0;
                    b5.needsUpdate = true
                }
                b6.__webglCustomAttributesList.push(b5)
            }
        }
    }

    function bF(b2, b0) {
        var b1 = b2.vertices.length;
        b2.__vertexArray = new Float32Array(b1 * 3);
        b2.__colorArray = new Float32Array(b1 * 3);
        b2.__sortArray = [];
        b2.__webglParticleCount = b1;
        bV(b0)
    }

    function J(b2, b0) {
        var b1 = b2.vertices.length;
        b2.__vertexArray = new Float32Array(b1 * 3);
        b2.__colorArray = new Float32Array(b1 * 3);
        b2.__lineDistanceArray = new Float32Array(b1 * 1);
        b2.__webglLineCount = b1;
        bV(b0)
    }

    function ak(ca, cf) {
        var b2 = cf.geometry,
            cg = ca.faces3,
            cc = cg.length * 3,
            b5 = cg.length * 1,
            b7 = cg.length * 3,
            b4 = K(cf, ca);
        ca.__vertexArray = new Float32Array(cc * 3);
        ca.__normalArray = new Float32Array(cc * 3);
        ca.__colorArray = new Float32Array(cc * 3);
        ca.__uvArray = new Float32Array(cc * 2);
        if (b2.faceVertexUvs.length > 1) {
            ca.__uv2Array = new Float32Array(cc * 2)
        }
        if (b2.hasTangents) {
            ca.__tangentArray = new Float32Array(cc * 4)
        }
        if (cf.geometry.skinWeights.length && cf.geometry.skinIndices.length) {
            ca.__skinIndexArray = new Float32Array(cc * 4);
            ca.__skinWeightArray = new Float32Array(cc * 4)
        }
        var b8 = a2.get("OES_element_index_uint") !== null && b5 > 21845 ? Uint32Array : Uint16Array;
        ca.__typeArray = b8;
        ca.__faceArray = new b8(b5 * 3);
        ca.__lineArray = new b8(b7 * 2);
        var b0 = ca.numMorphTargets;
        if (b0) {
            ca.__morphTargetsArrays = [];
            for (var cb = 0, ce = b0; cb < ce; cb++) {
                ca.__morphTargetsArrays.push(new Float32Array(cc * 3))
            }
        }
        var b1 = ca.numMorphNormals;
        if (b1) {
            ca.__morphNormalsArrays = [];
            for (var cb = 0, ce = b1; cb < ce; cb++) {
                ca.__morphNormalsArrays.push(new Float32Array(cc * 3))
            }
        }
        ca.__webglFaceCount = b5 * 3;
        ca.__webglLineCount = b7 * 2;
        if (b4.attributes) {
            if (ca.__webglCustomAttributesList === undefined) {
                ca.__webglCustomAttributesList = []
            }
            for (var ch in b4.attributes) {
                var cd = b4.attributes[ch];
                var b6 = {};
                for (var b3 in cd) {
                    b6[b3] = cd[b3]
                }
                if (!b6.__webglInitialized || b6.createUniqueBuffers) {
                    b6.__webglInitialized = true;
                    var b9 = 1;
                    if (b6.type === "v2") {
                        b9 = 2
                    } else {
                        if (b6.type === "v3") {
                            b9 = 3
                        } else {
                            if (b6.type === "v4") {
                                b9 = 4
                            } else {
                                if (b6.type === "c") {
                                    b9 = 3
                                }
                            }
                        }
                    }
                    b6.size = b9;
                    b6.array = new Float32Array(cc * b9);
                    b6.buffer = c.createBuffer();
                    b6.buffer.belongsToAttribute = ch;
                    cd.needsUpdate = true;
                    b6.__original = cd
                }
                ca.__webglCustomAttributesList.push(b6)
            }
        }
        ca.__inittedArrays = true
    }

    function K(b1, b0) {
        return b1.material instanceof THREE.MeshFaceMaterial ? b1.material.materials[b0.materialIndex] : b1.material
    }

    function bw(b0) {
        return b0 && b0.shading !== undefined && b0.shading === THREE.SmoothShading
    }

    function a5(b1, ce, cs) {
        var cc, cq, co, b3, b6, ck, b4 = b1.vertices,
            cp = b4.length,
            b8 = b1.colors,
            b7 = b8.length,
            cd = b1.__vertexArray,
            b0 = b1.__colorArray,
            b2 = b1.__sortArray,
            ci = b1.verticesNeedUpdate,
            b5 = b1.elementsNeedUpdate,
            cf = b1.colorsNeedUpdate,
            ch = b1.__webglCustomAttributesList,
            cm, b9, cr, cg, cb, cj, cn;
        if (ci) {
            for (cc = 0; cc < cp; cc++) {
                co = b4[cc];
                b3 = cc * 3;
                cd[b3] = co.x;
                cd[b3 + 1] = co.y;
                cd[b3 + 2] = co.z
            }
            c.bindBuffer(c.ARRAY_BUFFER, b1.__webglVertexBuffer);
            c.bufferData(c.ARRAY_BUFFER, cd, ce)
        }
        if (cf) {
            for (cq = 0; cq < b7; cq++) {
                ck = b8[cq];
                b3 = cq * 3;
                b0[b3] = ck.r;
                b0[b3 + 1] = ck.g;
                b0[b3 + 2] = ck.b
            }
            c.bindBuffer(c.ARRAY_BUFFER, b1.__webglColorBuffer);
            c.bufferData(c.ARRAY_BUFFER, b0, ce)
        }
        if (ch) {
            for (cm = 0, b9 = ch.length; cm < b9; cm++) {
                cn = ch[cm];
                if (cn.needsUpdate && (cn.boundTo === undefined || cn.boundTo === "vertices")) {
                    cb = cn.value.length;
                    b3 = 0;
                    if (cn.size === 1) {
                        for (cg = 0; cg < cb; cg++) {
                            cn.array[cg] = cn.value[cg]
                        }
                    } else {
                        if (cn.size === 2) {
                            for (cg = 0; cg < cb; cg++) {
                                cj = cn.value[cg];
                                cn.array[b3] = cj.x;
                                cn.array[b3 + 1] = cj.y;
                                b3 += 2
                            }
                        } else {
                            if (cn.size === 3) {
                                if (cn.type === "c") {
                                    for (cg = 0; cg < cb; cg++) {
                                        cj = cn.value[cg];
                                        cn.array[b3] = cj.r;
                                        cn.array[b3 + 1] = cj.g;
                                        cn.array[b3 + 2] = cj.b;
                                        b3 += 3
                                    }
                                } else {
                                    for (cg = 0; cg < cb; cg++) {
                                        cj = cn.value[cg];
                                        cn.array[b3] = cj.x;
                                        cn.array[b3 + 1] = cj.y;
                                        cn.array[b3 + 2] = cj.z;
                                        b3 += 3
                                    }
                                }
                            } else {
                                if (cn.size === 4) {
                                    for (cg = 0; cg < cb; cg++) {
                                        cj = cn.value[cg];
                                        cn.array[b3] = cj.x;
                                        cn.array[b3 + 1] = cj.y;
                                        cn.array[b3 + 2] = cj.z;
                                        cn.array[b3 + 3] = cj.w;
                                        b3 += 4
                                    }
                                }
                            }
                        }
                    }
                }
                c.bindBuffer(c.ARRAY_BUFFER, cn.buffer);
                c.bufferData(c.ARRAY_BUFFER, cn.array, ce);
                cn.needsUpdate = false
            }
        }
    }

    function bn(b3, ce) {
        var cb, cs, cq, cp, b4, ck, b5 = b3.vertices,
            b7 = b3.colors,
            cd = b3.lineDistances,
            cr = b5.length,
            b6 = b7.length,
            cm = cd.length,
            cc = b3.__vertexArray,
            b2 = b3.__colorArray,
            b0 = b3.__lineDistanceArray,
            ci = b3.verticesNeedUpdate,
            cf = b3.colorsNeedUpdate,
            b1 = b3.lineDistancesNeedUpdate,
            ch = b3.__webglCustomAttributesList,
            cn, b8, ct, cg, b9, cj, co;
        if (ci) {
            for (cb = 0; cb < cr; cb++) {
                cp = b5[cb];
                b4 = cb * 3;
                cc[b4] = cp.x;
                cc[b4 + 1] = cp.y;
                cc[b4 + 2] = cp.z
            }
            c.bindBuffer(c.ARRAY_BUFFER, b3.__webglVertexBuffer);
            c.bufferData(c.ARRAY_BUFFER, cc, ce)
        }
        if (cf) {
            for (cs = 0; cs < b6; cs++) {
                ck = b7[cs];
                b4 = cs * 3;
                b2[b4] = ck.r;
                b2[b4 + 1] = ck.g;
                b2[b4 + 2] = ck.b
            }
            c.bindBuffer(c.ARRAY_BUFFER, b3.__webglColorBuffer);
            c.bufferData(c.ARRAY_BUFFER, b2, ce)
        }
        if (b1) {
            for (cq = 0; cq < cm; cq++) {
                b0[cq] = cd[cq]
            }
            c.bindBuffer(c.ARRAY_BUFFER, b3.__webglLineDistanceBuffer);
            c.bufferData(c.ARRAY_BUFFER, b0, ce)
        }
        if (ch) {
            for (cn = 0, b8 = ch.length; cn < b8; cn++) {
                co = ch[cn];
                if (co.needsUpdate && (co.boundTo === undefined || co.boundTo === "vertices")) {
                    b4 = 0;
                    b9 = co.value.length;
                    if (co.size === 1) {
                        for (cg = 0; cg < b9; cg++) {
                            co.array[cg] = co.value[cg]
                        }
                    } else {
                        if (co.size === 2) {
                            for (cg = 0; cg < b9; cg++) {
                                cj = co.value[cg];
                                co.array[b4] = cj.x;
                                co.array[b4 + 1] = cj.y;
                                b4 += 2
                            }
                        } else {
                            if (co.size === 3) {
                                if (co.type === "c") {
                                    for (cg = 0; cg < b9; cg++) {
                                        cj = co.value[cg];
                                        co.array[b4] = cj.r;
                                        co.array[b4 + 1] = cj.g;
                                        co.array[b4 + 2] = cj.b;
                                        b4 += 3
                                    }
                                } else {
                                    for (cg = 0; cg < b9; cg++) {
                                        cj = co.value[cg];
                                        co.array[b4] = cj.x;
                                        co.array[b4 + 1] = cj.y;
                                        co.array[b4 + 2] = cj.z;
                                        b4 += 3
                                    }
                                }
                            } else {
                                if (co.size === 4) {
                                    for (cg = 0; cg < b9; cg++) {
                                        cj = co.value[cg];
                                        co.array[b4] = cj.x;
                                        co.array[b4 + 1] = cj.y;
                                        co.array[b4 + 2] = cj.z;
                                        co.array[b4 + 3] = cj.w;
                                        b4 += 4
                                    }
                                }
                            }
                        }
                    }
                    c.bindBuffer(c.ARRAY_BUFFER, co.buffer);
                    c.bufferData(c.ARRAY_BUFFER, co.array, ce);
                    co.needsUpdate = false
                }
            }
        }
    }

    function k(de, dk, dO, cd, dM) {
        if (!de.__inittedArrays) {
            return
        }
        var cz = bw(dM);
        var cP, dx, dD, b1, cg, b6, cU, ci, cJ, b2, cI, dJ, c6, c5, c4, c0, dK, dI, dG, dE, dC, dz, dy, dw, dc, db, c9, ds, dr, dn, dm, ca, b9, b8, b7, cF, cD, cC, cB, cn, cm, ck, cj, cL, dh, cO, cH, cs, c8, dd, ct, cA, cK, da, cQ, c7, cT, cp = 0,
            cf = 0,
            dg = 0,
            dH = 0,
            cM = 0,
            cy = 0,
            ch = 0,
            cZ = 0,
            ce = 0,
            cN = 0,
            b0 = 0,
            cb = 0,
            cl = 0,
            cE, b5 = de.__vertexArray,
            cx = de.__uvArray,
            cc = de.__uv2Array,
            dl = de.__normalArray,
            dq = de.__tangentArray,
            cW = de.__colorArray,
            dj = de.__skinIndexArray,
            dB = de.__skinWeightArray,
            dA = de.__morphTargetsArrays,
            cu = de.__morphNormalsArrays,
            cw = de.__webglCustomAttributesList,
            b4, dF = de.__faceArray,
            cS = de.__lineArray,
            df = dk.geometry,
            cr = df.verticesNeedUpdate,
            cR = df.elementsNeedUpdate,
            cX = df.uvsNeedUpdate,
            b3 = df.normalsNeedUpdate,
            dL = df.tangentsNeedUpdate,
            dp = df.colorsNeedUpdate,
            dP = df.morphTargetsNeedUpdate,
            cY = df.vertices,
            co = de.faces3,
            dt = df.faces,
            cV = df.faceVertexUvs[0],
            cv = df.faceVertexUvs[1],
            du = df.colors,
            cG = df.skinIndices,
            dv = df.skinWeights,
            dN = df.morphTargets,
            di = df.morphNormals;
        if (cr) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                b1 = dt[co[cP]];
                c6 = cY[b1.a];
                c5 = cY[b1.b];
                c4 = cY[b1.c];
                b5[cf] = c6.x;
                b5[cf + 1] = c6.y;
                b5[cf + 2] = c6.z;
                b5[cf + 3] = c5.x;
                b5[cf + 4] = c5.y;
                b5[cf + 5] = c5.z;
                b5[cf + 6] = c4.x;
                b5[cf + 7] = c4.y;
                b5[cf + 8] = c4.z;
                cf += 9
            }
            c.bindBuffer(c.ARRAY_BUFFER, de.__webglVertexBuffer);
            c.bufferData(c.ARRAY_BUFFER, b5, dO)
        }
        if (dP) {
            for (ct = 0, cA = dN.length; ct < cA; ct++) {
                b0 = 0;
                for (cP = 0, dx = co.length; cP < dx; cP++) {
                    cQ = co[cP];
                    b1 = dt[cQ];
                    c6 = dN[ct].vertices[b1.a];
                    c5 = dN[ct].vertices[b1.b];
                    c4 = dN[ct].vertices[b1.c];
                    cK = dA[ct];
                    cK[b0] = c6.x;
                    cK[b0 + 1] = c6.y;
                    cK[b0 + 2] = c6.z;
                    cK[b0 + 3] = c5.x;
                    cK[b0 + 4] = c5.y;
                    cK[b0 + 5] = c5.z;
                    cK[b0 + 6] = c4.x;
                    cK[b0 + 7] = c4.y;
                    cK[b0 + 8] = c4.z;
                    if (dM.morphNormals) {
                        if (cz) {
                            c7 = di[ct].vertexNormals[cQ];
                            dC = c7.a;
                            dz = c7.b;
                            dy = c7.c
                        } else {
                            dC = di[ct].faceNormals[cQ];
                            dz = dC;
                            dy = dC
                        }
                        da = cu[ct];
                        da[b0] = dC.x;
                        da[b0 + 1] = dC.y;
                        da[b0 + 2] = dC.z;
                        da[b0 + 3] = dz.x;
                        da[b0 + 4] = dz.y;
                        da[b0 + 5] = dz.z;
                        da[b0 + 6] = dy.x;
                        da[b0 + 7] = dy.y;
                        da[b0 + 8] = dy.z
                    }
                    b0 += 9
                }
                c.bindBuffer(c.ARRAY_BUFFER, de.__webglMorphTargetsBuffers[ct]);
                c.bufferData(c.ARRAY_BUFFER, dA[ct], dO);
                if (dM.morphNormals) {
                    c.bindBuffer(c.ARRAY_BUFFER, de.__webglMorphNormalsBuffers[ct]);
                    c.bufferData(c.ARRAY_BUFFER, cu[ct], dO)
                }
            }
        }
        if (dv.length) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                b1 = dt[co[cP]];
                ds = dv[b1.a];
                dr = dv[b1.b];
                dn = dv[b1.c];
                dB[cN] = ds.x;
                dB[cN + 1] = ds.y;
                dB[cN + 2] = ds.z;
                dB[cN + 3] = ds.w;
                dB[cN + 4] = dr.x;
                dB[cN + 5] = dr.y;
                dB[cN + 6] = dr.z;
                dB[cN + 7] = dr.w;
                dB[cN + 8] = dn.x;
                dB[cN + 9] = dn.y;
                dB[cN + 10] = dn.z;
                dB[cN + 11] = dn.w;
                ca = cG[b1.a];
                b9 = cG[b1.b];
                b8 = cG[b1.c];
                dj[cN] = ca.x;
                dj[cN + 1] = ca.y;
                dj[cN + 2] = ca.z;
                dj[cN + 3] = ca.w;
                dj[cN + 4] = b9.x;
                dj[cN + 5] = b9.y;
                dj[cN + 6] = b9.z;
                dj[cN + 7] = b9.w;
                dj[cN + 8] = b8.x;
                dj[cN + 9] = b8.y;
                dj[cN + 10] = b8.z;
                dj[cN + 11] = b8.w;
                cN += 12
            }
            if (cN > 0) {
                c.bindBuffer(c.ARRAY_BUFFER, de.__webglSkinIndicesBuffer);
                c.bufferData(c.ARRAY_BUFFER, dj, dO);
                c.bindBuffer(c.ARRAY_BUFFER, de.__webglSkinWeightsBuffer);
                c.bufferData(c.ARRAY_BUFFER, dB, dO)
            }
        }
        if (dp) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                b1 = dt[co[cP]];
                ci = b1.vertexColors;
                cJ = b1.color;
                if (ci.length === 3 && dM.vertexColors === THREE.VertexColors) {
                    dc = ci[0];
                    db = ci[1];
                    c9 = ci[2]
                } else {
                    dc = cJ;
                    db = cJ;
                    c9 = cJ
                }
                cW[ce] = dc.r;
                cW[ce + 1] = dc.g;
                cW[ce + 2] = dc.b;
                cW[ce + 3] = db.r;
                cW[ce + 4] = db.g;
                cW[ce + 5] = db.b;
                cW[ce + 6] = c9.r;
                cW[ce + 7] = c9.g;
                cW[ce + 8] = c9.b;
                ce += 9
            }
            if (ce > 0) {
                c.bindBuffer(c.ARRAY_BUFFER, de.__webglColorBuffer);
                c.bufferData(c.ARRAY_BUFFER, cW, dO)
            }
        }
        if (dL && df.hasTangents) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                b1 = dt[co[cP]];
                b2 = b1.vertexTangents;
                dK = b2[0];
                dI = b2[1];
                dG = b2[2];
                dq[ch] = dK.x;
                dq[ch + 1] = dK.y;
                dq[ch + 2] = dK.z;
                dq[ch + 3] = dK.w;
                dq[ch + 4] = dI.x;
                dq[ch + 5] = dI.y;
                dq[ch + 6] = dI.z;
                dq[ch + 7] = dI.w;
                dq[ch + 8] = dG.x;
                dq[ch + 9] = dG.y;
                dq[ch + 10] = dG.z;
                dq[ch + 11] = dG.w;
                ch += 12
            }
            c.bindBuffer(c.ARRAY_BUFFER, de.__webglTangentBuffer);
            c.bufferData(c.ARRAY_BUFFER, dq, dO)
        }
        if (b3) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                b1 = dt[co[cP]];
                cg = b1.vertexNormals;
                b6 = b1.normal;
                if (cg.length === 3 && cz) {
                    for (cO = 0; cO < 3; cO++) {
                        cs = cg[cO];
                        dl[cy] = cs.x;
                        dl[cy + 1] = cs.y;
                        dl[cy + 2] = cs.z;
                        cy += 3
                    }
                } else {
                    for (cO = 0; cO < 3; cO++) {
                        dl[cy] = b6.x;
                        dl[cy + 1] = b6.y;
                        dl[cy + 2] = b6.z;
                        cy += 3
                    }
                }
            }
            c.bindBuffer(c.ARRAY_BUFFER, de.__webglNormalBuffer);
            c.bufferData(c.ARRAY_BUFFER, dl, dO)
        }
        if (cX && cV) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                dD = co[cP];
                cI = cV[dD];
                if (cI === undefined) {
                    continue
                }
                for (cO = 0; cO < 3; cO++) {
                    c8 = cI[cO];
                    cx[dg] = c8.x;
                    cx[dg + 1] = c8.y;
                    dg += 2
                }
            }
            if (dg > 0) {
                c.bindBuffer(c.ARRAY_BUFFER, de.__webglUVBuffer);
                c.bufferData(c.ARRAY_BUFFER, cx, dO)
            }
        }
        if (cX && cv) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                dD = co[cP];
                dJ = cv[dD];
                if (dJ === undefined) {
                    continue
                }
                for (cO = 0; cO < 3; cO++) {
                    dd = dJ[cO];
                    cc[dH] = dd.x;
                    cc[dH + 1] = dd.y;
                    dH += 2
                }
            }
            if (dH > 0) {
                c.bindBuffer(c.ARRAY_BUFFER, de.__webglUV2Buffer);
                c.bufferData(c.ARRAY_BUFFER, cc, dO)
            }
        }
        if (cR) {
            for (cP = 0, dx = co.length; cP < dx; cP++) {
                dF[cM] = cp;
                dF[cM + 1] = cp + 1;
                dF[cM + 2] = cp + 2;
                cM += 3;
                cS[cZ] = cp;
                cS[cZ + 1] = cp + 1;
                cS[cZ + 2] = cp;
                cS[cZ + 3] = cp + 2;
                cS[cZ + 4] = cp + 1;
                cS[cZ + 5] = cp + 2;
                cZ += 6;
                cp += 3
            }
            c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, de.__webglFaceBuffer);
            c.bufferData(c.ELEMENT_ARRAY_BUFFER, dF, dO);
            c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, de.__webglLineBuffer);
            c.bufferData(c.ELEMENT_ARRAY_BUFFER, cS, dO)
        }
        if (cw) {
            for (cO = 0, cH = cw.length; cO < cH; cO++) {
                b4 = cw[cO];
                if (!b4.__original.needsUpdate) {
                    continue
                }
                cb = 0;
                cl = 0;
                if (b4.size === 1) {
                    if (b4.boundTo === undefined || b4.boundTo === "vertices") {
                        for (cP = 0, dx = co.length; cP < dx; cP++) {
                            b1 = dt[co[cP]];
                            b4.array[cb] = b4.value[b1.a];
                            b4.array[cb + 1] = b4.value[b1.b];
                            b4.array[cb + 2] = b4.value[b1.c];
                            cb += 3
                        }
                    } else {
                        if (b4.boundTo === "faces") {
                            for (cP = 0, dx = co.length; cP < dx; cP++) {
                                cE = b4.value[co[cP]];
                                b4.array[cb] = cE;
                                b4.array[cb + 1] = cE;
                                b4.array[cb + 2] = cE;
                                cb += 3
                            }
                        }
                    }
                } else {
                    if (b4.size === 2) {
                        if (b4.boundTo === undefined || b4.boundTo === "vertices") {
                            for (cP = 0, dx = co.length; cP < dx; cP++) {
                                b1 = dt[co[cP]];
                                c6 = b4.value[b1.a];
                                c5 = b4.value[b1.b];
                                c4 = b4.value[b1.c];
                                b4.array[cb] = c6.x;
                                b4.array[cb + 1] = c6.y;
                                b4.array[cb + 2] = c5.x;
                                b4.array[cb + 3] = c5.y;
                                b4.array[cb + 4] = c4.x;
                                b4.array[cb + 5] = c4.y;
                                cb += 6
                            }
                        } else {
                            if (b4.boundTo === "faces") {
                                for (cP = 0, dx = co.length; cP < dx; cP++) {
                                    cE = b4.value[co[cP]];
                                    c6 = cE;
                                    c5 = cE;
                                    c4 = cE;
                                    b4.array[cb] = c6.x;
                                    b4.array[cb + 1] = c6.y;
                                    b4.array[cb + 2] = c5.x;
                                    b4.array[cb + 3] = c5.y;
                                    b4.array[cb + 4] = c4.x;
                                    b4.array[cb + 5] = c4.y;
                                    cb += 6
                                }
                            }
                        }
                    } else {
                        if (b4.size === 3) {
                            var cq;
                            if (b4.type === "c") {
                                cq = ["r", "g", "b"]
                            } else {
                                cq = ["x", "y", "z"]
                            }
                            if (b4.boundTo === undefined || b4.boundTo === "vertices") {
                                for (cP = 0, dx = co.length; cP < dx; cP++) {
                                    b1 = dt[co[cP]];
                                    c6 = b4.value[b1.a];
                                    c5 = b4.value[b1.b];
                                    c4 = b4.value[b1.c];
                                    b4.array[cb] = c6[cq[0]];
                                    b4.array[cb + 1] = c6[cq[1]];
                                    b4.array[cb + 2] = c6[cq[2]];
                                    b4.array[cb + 3] = c5[cq[0]];
                                    b4.array[cb + 4] = c5[cq[1]];
                                    b4.array[cb + 5] = c5[cq[2]];
                                    b4.array[cb + 6] = c4[cq[0]];
                                    b4.array[cb + 7] = c4[cq[1]];
                                    b4.array[cb + 8] = c4[cq[2]];
                                    cb += 9
                                }
                            } else {
                                if (b4.boundTo === "faces") {
                                    for (cP = 0, dx = co.length; cP < dx; cP++) {
                                        cE = b4.value[co[cP]];
                                        c6 = cE;
                                        c5 = cE;
                                        c4 = cE;
                                        b4.array[cb] = c6[cq[0]];
                                        b4.array[cb + 1] = c6[cq[1]];
                                        b4.array[cb + 2] = c6[cq[2]];
                                        b4.array[cb + 3] = c5[cq[0]];
                                        b4.array[cb + 4] = c5[cq[1]];
                                        b4.array[cb + 5] = c5[cq[2]];
                                        b4.array[cb + 6] = c4[cq[0]];
                                        b4.array[cb + 7] = c4[cq[1]];
                                        b4.array[cb + 8] = c4[cq[2]];
                                        cb += 9
                                    }
                                } else {
                                    if (b4.boundTo === "faceVertices") {
                                        for (cP = 0, dx = co.length; cP < dx; cP++) {
                                            cE = b4.value[co[cP]];
                                            c6 = cE[0];
                                            c5 = cE[1];
                                            c4 = cE[2];
                                            b4.array[cb] = c6[cq[0]];
                                            b4.array[cb + 1] = c6[cq[1]];
                                            b4.array[cb + 2] = c6[cq[2]];
                                            b4.array[cb + 3] = c5[cq[0]];
                                            b4.array[cb + 4] = c5[cq[1]];
                                            b4.array[cb + 5] = c5[cq[2]];
                                            b4.array[cb + 6] = c4[cq[0]];
                                            b4.array[cb + 7] = c4[cq[1]];
                                            b4.array[cb + 8] = c4[cq[2]];
                                            cb += 9
                                        }
                                    }
                                }
                            }
                        } else {
                            if (b4.size === 4) {
                                if (b4.boundTo === undefined || b4.boundTo === "vertices") {
                                    for (cP = 0, dx = co.length; cP < dx; cP++) {
                                        b1 = dt[co[cP]];
                                        c6 = b4.value[b1.a];
                                        c5 = b4.value[b1.b];
                                        c4 = b4.value[b1.c];
                                        b4.array[cb] = c6.x;
                                        b4.array[cb + 1] = c6.y;
                                        b4.array[cb + 2] = c6.z;
                                        b4.array[cb + 3] = c6.w;
                                        b4.array[cb + 4] = c5.x;
                                        b4.array[cb + 5] = c5.y;
                                        b4.array[cb + 6] = c5.z;
                                        b4.array[cb + 7] = c5.w;
                                        b4.array[cb + 8] = c4.x;
                                        b4.array[cb + 9] = c4.y;
                                        b4.array[cb + 10] = c4.z;
                                        b4.array[cb + 11] = c4.w;
                                        cb += 12
                                    }
                                } else {
                                    if (b4.boundTo === "faces") {
                                        for (cP = 0, dx = co.length; cP < dx; cP++) {
                                            cE = b4.value[co[cP]];
                                            c6 = cE;
                                            c5 = cE;
                                            c4 = cE;
                                            b4.array[cb] = c6.x;
                                            b4.array[cb + 1] = c6.y;
                                            b4.array[cb + 2] = c6.z;
                                            b4.array[cb + 3] = c6.w;
                                            b4.array[cb + 4] = c5.x;
                                            b4.array[cb + 5] = c5.y;
                                            b4.array[cb + 6] = c5.z;
                                            b4.array[cb + 7] = c5.w;
                                            b4.array[cb + 8] = c4.x;
                                            b4.array[cb + 9] = c4.y;
                                            b4.array[cb + 10] = c4.z;
                                            b4.array[cb + 11] = c4.w;
                                            cb += 12
                                        }
                                    } else {
                                        if (b4.boundTo === "faceVertices") {
                                            for (cP = 0, dx = co.length; cP < dx; cP++) {
                                                cE = b4.value[co[cP]];
                                                c6 = cE[0];
                                                c5 = cE[1];
                                                c4 = cE[2];
                                                b4.array[cb] = c6.x;
                                                b4.array[cb + 1] = c6.y;
                                                b4.array[cb + 2] = c6.z;
                                                b4.array[cb + 3] = c6.w;
                                                b4.array[cb + 4] = c5.x;
                                                b4.array[cb + 5] = c5.y;
                                                b4.array[cb + 6] = c5.z;
                                                b4.array[cb + 7] = c5.w;
                                                b4.array[cb + 8] = c4.x;
                                                b4.array[cb + 9] = c4.y;
                                                b4.array[cb + 10] = c4.z;
                                                b4.array[cb + 11] = c4.w;
                                                cb += 12
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                c.bindBuffer(c.ARRAY_BUFFER, b4.buffer);
                c.bufferData(c.ARRAY_BUFFER, b4.array, dO)
            }
        }
        if (cd) {
            delete de.__inittedArrays;
            delete de.__colorArray;
            delete de.__normalArray;
            delete de.__tangentArray;
            delete de.__uvArray;
            delete de.__uv2Array;
            delete de.__faceArray;
            delete de.__vertexArray;
            delete de.__lineArray;
            delete de.__skinIndexArray;
            delete de.__skinWeightArray
        }
    }
    this.renderBufferImmediate = function(cf, b3, b5) {
        r();
        if (cf.hasPositions && !cf.__webglVertexBuffer) {
            cf.__webglVertexBuffer = c.createBuffer()
        }
        if (cf.hasNormals && !cf.__webglNormalBuffer) {
            cf.__webglNormalBuffer = c.createBuffer()
        }
        if (cf.hasUvs && !cf.__webglUvBuffer) {
            cf.__webglUvBuffer = c.createBuffer()
        }
        if (cf.hasColors && !cf.__webglColorBuffer) {
            cf.__webglColorBuffer = c.createBuffer()
        }
        if (cf.hasPositions) {
            c.bindBuffer(c.ARRAY_BUFFER, cf.__webglVertexBuffer);
            c.bufferData(c.ARRAY_BUFFER, cf.positionArray, c.DYNAMIC_DRAW);
            ah(b3.attributes.position);
            c.vertexAttribPointer(b3.attributes.position, 3, c.FLOAT, false, 0, 0)
        }
        if (cf.hasNormals) {
            c.bindBuffer(c.ARRAY_BUFFER, cf.__webglNormalBuffer);
            if (b5.shading === THREE.FlatShading) {
                var cd, cc, ca, b2, b8, ch, b1, b7, cg, b0, b6, ce, cb, b9, b4 = cf.count * 3;
                for (b9 = 0; b9 < b4; b9 += 9) {
                    cb = cf.normalArray;
                    b2 = cb[b9];
                    b1 = cb[b9 + 1];
                    b0 = cb[b9 + 2];
                    b8 = cb[b9 + 3];
                    b7 = cb[b9 + 4];
                    b6 = cb[b9 + 5];
                    ch = cb[b9 + 6];
                    cg = cb[b9 + 7];
                    ce = cb[b9 + 8];
                    cd = (b2 + b8 + ch) / 3;
                    cc = (b1 + b7 + cg) / 3;
                    ca = (b0 + b6 + ce) / 3;
                    cb[b9] = cd;
                    cb[b9 + 1] = cc;
                    cb[b9 + 2] = ca;
                    cb[b9 + 3] = cd;
                    cb[b9 + 4] = cc;
                    cb[b9 + 5] = ca;
                    cb[b9 + 6] = cd;
                    cb[b9 + 7] = cc;
                    cb[b9 + 8] = ca
                }
            }
            c.bufferData(c.ARRAY_BUFFER, cf.normalArray, c.DYNAMIC_DRAW);
            ah(b3.attributes.normal);
            c.vertexAttribPointer(b3.attributes.normal, 3, c.FLOAT, false, 0, 0)
        }
        if (cf.hasUvs && b5.map) {
            c.bindBuffer(c.ARRAY_BUFFER, cf.__webglUvBuffer);
            c.bufferData(c.ARRAY_BUFFER, cf.uvArray, c.DYNAMIC_DRAW);
            ah(b3.attributes.uv);
            c.vertexAttribPointer(b3.attributes.uv, 2, c.FLOAT, false, 0, 0)
        }
        if (cf.hasColors && b5.vertexColors !== THREE.NoColors) {
            c.bindBuffer(c.ARRAY_BUFFER, cf.__webglColorBuffer);
            c.bufferData(c.ARRAY_BUFFER, cf.colorArray, c.DYNAMIC_DRAW);
            ah(b3.attributes.color);
            c.vertexAttribPointer(b3.attributes.color, 3, c.FLOAT, false, 0, 0)
        }
        g();
        c.drawArrays(c.TRIANGLES, 0, cf.count);
        cf.count = 0
    };

    function Y(b6, b4, b7, ca) {
        var b5 = b7.attributes;
        var b0 = b4.attributes;
        var b9 = b4.attributesKeys;
        for (var b3 = 0, b1 = b9.length; b3 < b1; b3++) {
            var b8 = b9[b3];
            var b2 = b0[b8];
            if (b2 >= 0) {
                var cc = b5[b8];
                if (cc !== undefined) {
                    var cb = cc.itemSize;
                    c.bindBuffer(c.ARRAY_BUFFER, cc.buffer);
                    ah(b2);
                    c.vertexAttribPointer(b2, cb, c.FLOAT, false, 0, ca * cb * 4)
                } else {
                    if (b6.defaultAttributeValues !== undefined) {
                        if (b6.defaultAttributeValues[b8].length === 2) {
                            c.vertexAttrib2fv(b2, b6.defaultAttributeValues[b8])
                        } else {
                            if (b6.defaultAttributeValues[b8].length === 3) {
                                c.vertexAttrib3fv(b2, b6.defaultAttributeValues[b8])
                            }
                        }
                    }
                }
            }
        }
        g()
    }
    this.renderBufferDirect = function(cf, cg, b0, b8, b3, ci) {
        if (b8.visible === false) {
            return
        }
        L(ci);
        var b6 = aM(cf, cg, b0, b8, ci);
        var cb = false,
            cd = b8.wireframe ? 1 : 0,
            cc = "direct_" + b3.id + "_" + b6.id + "_" + cd;
        if (cc !== aA) {
            aA = cc;
            cb = true
        }
        if (cb) {
            r()
        }
        if (ci instanceof THREE.Mesh) {
            var b9 = b8.wireframe === true ? c.LINES : c.TRIANGLES;
            var b5 = b3.attributes.index;
            if (b5) {
                var b1, ca;
                if (b5.array instanceof Uint32Array && a2.get("OES_element_index_uint")) {
                    b1 = c.UNSIGNED_INT;
                    ca = 4
                } else {
                    b1 = c.UNSIGNED_SHORT;
                    ca = 2
                }
                var b4 = b3.offsets;
                if (b4.length === 0) {
                    if (cb) {
                        Y(b8, b6, b3, 0);
                        c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.buffer)
                    }
                    c.drawElements(b9, b5.array.length, b1, 0);
                    aK.info.render.calls++;
                    aK.info.render.vertices += b5.array.length;
                    aK.info.render.faces += b5.array.length / 3
                } else {
                    cb = true;
                    for (var ce = 0, b7 = b4.length; ce < b7; ce++) {
                        var b2 = b4[ce].index;
                        if (cb) {
                            Y(b8, b6, b3, b2);
                            c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.buffer)
                        }
                        c.drawElements(b9, b4[ce].count, b1, b4[ce].start * ca);
                        aK.info.render.calls++;
                        aK.info.render.vertices += b4[ce].count;
                        aK.info.render.faces += b4[ce].count / 3
                    }
                }
            } else {
                if (cb) {
                    Y(b8, b6, b3, 0)
                }
                var ch = b3.attributes.position;
                c.drawArrays(b9, 0, ch.array.length / 3);
                aK.info.render.calls++;
                aK.info.render.vertices += ch.array.length / 3;
                aK.info.render.faces += ch.array.length / 9
            }
        } else {
            if (ci instanceof THREE.PointCloud) {
                var b9 = c.POINTS;
                var b5 = b3.attributes.index;
                if (b5) {
                    var b1, ca;
                    if (b5.array instanceof Uint32Array && a2.get("OES_element_index_uint")) {
                        b1 = c.UNSIGNED_INT;
                        ca = 4
                    } else {
                        b1 = c.UNSIGNED_SHORT;
                        ca = 2
                    }
                    var b4 = b3.offsets;
                    if (b4.length === 0) {
                        if (cb) {
                            Y(b8, b6, b3, 0);
                            c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.buffer)
                        }
                        c.drawElements(b9, b5.array.length, b1, 0);
                        aK.info.render.calls++;
                        aK.info.render.points += b5.array.length
                    } else {
                        if (b4.length > 1) {
                            cb = true
                        }
                        for (var ce = 0, b7 = b4.length; ce < b7; ce++) {
                            var b2 = b4[ce].index;
                            if (cb) {
                                Y(b8, b6, b3, b2);
                                c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.buffer)
                            }
                            c.drawElements(b9, b4[ce].count, b1, b4[ce].start * ca);
                            aK.info.render.calls++;
                            aK.info.render.points += b4[ce].count
                        }
                    }
                } else {
                    if (cb) {
                        Y(b8, b6, b3, 0)
                    }
                    var ch = b3.attributes.position;
                    var b4 = b3.offsets;
                    if (b4.length === 0) {
                        c.drawArrays(b9, 0, ch.array.length / 3);
                        aK.info.render.calls++;
                        aK.info.render.points += ch.array.length / 3
                    } else {
                        for (var ce = 0, b7 = b4.length; ce < b7; ce++) {
                            c.drawArrays(b9, b4[ce].index, b4[ce].count);
                            aK.info.render.calls++;
                            aK.info.render.points += b4[ce].count
                        }
                    }
                }
            } else {
                if (ci instanceof THREE.Line) {
                    var b9 = (ci.mode === THREE.LineStrip) ? c.LINE_STRIP : c.LINES;
                    aD(b8.linewidth);
                    var b5 = b3.attributes.index;
                    if (b5) {
                        var b1, ca;
                        if (b5.array instanceof Uint32Array) {
                            b1 = c.UNSIGNED_INT;
                            ca = 4
                        } else {
                            b1 = c.UNSIGNED_SHORT;
                            ca = 2
                        }
                        var b4 = b3.offsets;
                        if (b4.length === 0) {
                            if (cb) {
                                Y(b8, b6, b3, 0);
                                c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.buffer)
                            }
                            c.drawElements(b9, b5.array.length, b1, 0);
                            aK.info.render.calls++;
                            aK.info.render.vertices += b5.array.length
                        } else {
                            if (b4.length > 1) {
                                cb = true
                            }
                            for (var ce = 0, b7 = b4.length; ce < b7; ce++) {
                                var b2 = b4[ce].index;
                                if (cb) {
                                    Y(b8, b6, b3, b2);
                                    c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.buffer)
                                }
                                c.drawElements(b9, b4[ce].count, b1, b4[ce].start * ca);
                                aK.info.render.calls++;
                                aK.info.render.vertices += b4[ce].count
                            }
                        }
                    } else {
                        if (cb) {
                            Y(b8, b6, b3, 0)
                        }
                        var ch = b3.attributes.position;
                        var b4 = b3.offsets;
                        if (b4.length === 0) {
                            c.drawArrays(b9, 0, ch.array.length / 3);
                            aK.info.render.calls++;
                            aK.info.render.vertices += ch.array.length / 3
                        } else {
                            for (var ce = 0, b7 = b4.length; ce < b7; ce++) {
                                c.drawArrays(b9, b4[ce].index, b4[ce].count);
                                aK.info.render.calls++;
                                aK.info.render.vertices += b4[ce].count
                            }
                        }
                    }
                }
            }
        }
    };
    this.renderBuffer = function(cb, b6, b0, cc, b5, b4) {
        if (cc.visible === false) {
            return
        }
        L(b4);
        var b9 = aM(cb, b6, b0, cc, b4);
        var b7 = b9.attributes;
        var b3 = false,
            ce = cc.wireframe ? 1 : 0,
            b2 = b5.id + "_" + b9.id + "_" + ce;
        if (b2 !== aA) {
            aA = b2;
            b3 = true
        }
        if (b3) {
            r()
        }
        if (!cc.morphTargets && b7.position >= 0) {
            if (b3) {
                c.bindBuffer(c.ARRAY_BUFFER, b5.__webglVertexBuffer);
                ah(b7.position);
                c.vertexAttribPointer(b7.position, 3, c.FLOAT, false, 0, 0)
            }
        } else {
            if (b4.morphTargetBase) {
                v(cc, b5, b4)
            }
        }
        if (b3) {
            if (b5.__webglCustomAttributesList) {
                for (var b8 = 0, cf = b5.__webglCustomAttributesList.length; b8 < cf; b8++) {
                    var b1 = b5.__webglCustomAttributesList[b8];
                    if (b7[b1.buffer.belongsToAttribute] >= 0) {
                        c.bindBuffer(c.ARRAY_BUFFER, b1.buffer);
                        ah(b7[b1.buffer.belongsToAttribute]);
                        c.vertexAttribPointer(b7[b1.buffer.belongsToAttribute], b1.size, c.FLOAT, false, 0, 0)
                    }
                }
            }
            if (b7.color >= 0) {
                if (b4.geometry.colors.length > 0 || b4.geometry.faces.length > 0) {
                    c.bindBuffer(c.ARRAY_BUFFER, b5.__webglColorBuffer);
                    ah(b7.color);
                    c.vertexAttribPointer(b7.color, 3, c.FLOAT, false, 0, 0)
                } else {
                    if (cc.defaultAttributeValues !== undefined) {
                        c.vertexAttrib3fv(b7.color, cc.defaultAttributeValues.color)
                    }
                }
            }
            if (b7.normal >= 0) {
                c.bindBuffer(c.ARRAY_BUFFER, b5.__webglNormalBuffer);
                ah(b7.normal);
                c.vertexAttribPointer(b7.normal, 3, c.FLOAT, false, 0, 0)
            }
            if (b7.tangent >= 0) {
                c.bindBuffer(c.ARRAY_BUFFER, b5.__webglTangentBuffer);
                ah(b7.tangent);
                c.vertexAttribPointer(b7.tangent, 4, c.FLOAT, false, 0, 0)
            }
            if (b7.uv >= 0) {
                if (b4.geometry.faceVertexUvs[0]) {
                    c.bindBuffer(c.ARRAY_BUFFER, b5.__webglUVBuffer);
                    ah(b7.uv);
                    c.vertexAttribPointer(b7.uv, 2, c.FLOAT, false, 0, 0)
                } else {
                    if (cc.defaultAttributeValues !== undefined) {
                        c.vertexAttrib2fv(b7.uv, cc.defaultAttributeValues.uv)
                    }
                }
            }
            if (b7.uv2 >= 0) {
                if (b4.geometry.faceVertexUvs[1]) {
                    c.bindBuffer(c.ARRAY_BUFFER, b5.__webglUV2Buffer);
                    ah(b7.uv2);
                    c.vertexAttribPointer(b7.uv2, 2, c.FLOAT, false, 0, 0)
                } else {
                    if (cc.defaultAttributeValues !== undefined) {
                        c.vertexAttrib2fv(b7.uv2, cc.defaultAttributeValues.uv2)
                    }
                }
            }
            if (cc.skinning && b7.skinIndex >= 0 && b7.skinWeight >= 0) {
                c.bindBuffer(c.ARRAY_BUFFER, b5.__webglSkinIndicesBuffer);
                ah(b7.skinIndex);
                c.vertexAttribPointer(b7.skinIndex, 4, c.FLOAT, false, 0, 0);
                c.bindBuffer(c.ARRAY_BUFFER, b5.__webglSkinWeightsBuffer);
                ah(b7.skinWeight);
                c.vertexAttribPointer(b7.skinWeight, 4, c.FLOAT, false, 0, 0)
            }
            if (b7.lineDistance >= 0) {
                c.bindBuffer(c.ARRAY_BUFFER, b5.__webglLineDistanceBuffer);
                ah(b7.lineDistance);
                c.vertexAttribPointer(b7.lineDistance, 1, c.FLOAT, false, 0, 0)
            }
        }
        g();
        if (b4 instanceof THREE.Mesh) {
            var cd = b5.__typeArray === Uint32Array ? c.UNSIGNED_INT : c.UNSIGNED_SHORT;
            if (cc.wireframe) {
                aD(cc.wireframeLinewidth);
                if (b3) {
                    c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.__webglLineBuffer)
                }
                c.drawElements(c.LINES, b5.__webglLineCount, cd, 0)
            } else {
                if (b3) {
                    c.bindBuffer(c.ELEMENT_ARRAY_BUFFER, b5.__webglFaceBuffer)
                }
                c.drawElements(c.TRIANGLES, b5.__webglFaceCount, cd, 0)
            }
            aK.info.render.calls++;
            aK.info.render.vertices += b5.__webglFaceCount;
            aK.info.render.faces += b5.__webglFaceCount / 3
        } else {
            if (b4 instanceof THREE.Line) {
                var ca = (b4.mode === THREE.LineStrip) ? c.LINE_STRIP : c.LINES;
                aD(cc.linewidth);
                c.drawArrays(ca, 0, b5.__webglLineCount);
                aK.info.render.calls++
            } else {
                if (b4 instanceof THREE.PointCloud) {
                    c.drawArrays(c.POINTS, 0, b5.__webglParticleCount);
                    aK.info.render.calls++;
                    aK.info.render.points += b5.__webglParticleCount
                }
            }
        }
    };

    function r() {
        for (var b1 = 0, b0 = ao.length; b1 < b0; b1++) {
            ao[b1] = 0
        }
    }

    function ah(b0) {
        ao[b0] = 1;
        if (M[b0] === 0) {
            c.enableVertexAttribArray(b0);
            M[b0] = 1
        }
    }

    function g() {
        for (var b1 = 0, b0 = M.length; b1 < b0; b1++) {
            if (M[b1] !== ao[b1]) {
                c.disableVertexAttribArray(b1);
                M[b1] = 0
            }
        }
    }

    function v(ca, b5, b4) {
        var b8 = ca.program.attributes;
        if (b4.morphTargetBase !== -1 && b8.position >= 0) {
            c.bindBuffer(c.ARRAY_BUFFER, b5.__webglMorphTargetsBuffers[b4.morphTargetBase]);
            ah(b8.position);
            c.vertexAttribPointer(b8.position, 3, c.FLOAT, false, 0, 0)
        } else {
            if (b8.position >= 0) {
                c.bindBuffer(c.ARRAY_BUFFER, b5.__webglVertexBuffer);
                ah(b8.position);
                c.vertexAttribPointer(b8.position, 3, c.FLOAT, false, 0, 0)
            }
        }
        if (b4.morphTargetForcedOrder.length) {
            var b1 = 0;
            var b2 = b4.morphTargetForcedOrder;
            var cc = b4.morphTargetInfluences;
            var b0;
            while (b1 < ca.numSupportedMorphTargets && b1 < b2.length) {
                b0 = b8["morphTarget" + b1];
                if (b0 >= 0) {
                    c.bindBuffer(c.ARRAY_BUFFER, b5.__webglMorphTargetsBuffers[b2[b1]]);
                    ah(b0);
                    c.vertexAttribPointer(b0, 3, c.FLOAT, false, 0, 0)
                }
                b0 = b8["morphNormal" + b1];
                if (b0 >= 0 && ca.morphNormals) {
                    c.bindBuffer(c.ARRAY_BUFFER, b5.__webglMorphNormalsBuffers[b2[b1]]);
                    ah(b0);
                    c.vertexAttribPointer(b0, 3, c.FLOAT, false, 0, 0)
                }
                b4.__webglMorphTargetInfluences[b1] = cc[b2[b1]];
                b1++
            }
        } else {
            var b3 = [];
            var cc = b4.morphTargetInfluences;
            for (var b9 = 0, cd = cc.length; b9 < cd; b9++) {
                var cb = cc[b9];
                b3.push([cb, b9])
            }
            if (b3.length > ca.numSupportedMorphTargets) {
                b3.sort(ac);
                b3.length = ca.numSupportedMorphTargets
            } else {
                if (b3.length > ca.numSupportedMorphNormals) {
                    b3.sort(ac)
                } else {
                    if (b3.length === 0) {
                        b3.push([0, 0])
                    }
                }
            }
            var b0;
            for (var b1 = 0, b7 = ca.numSupportedMorphTargets; b1 < b7; b1++) {
                if (b3[b1]) {
                    var b6 = b3[b1][1];
                    b0 = b8["morphTarget" + b1];
                    if (b0 >= 0) {
                        c.bindBuffer(c.ARRAY_BUFFER, b5.__webglMorphTargetsBuffers[b6]);
                        ah(b0);
                        c.vertexAttribPointer(b0, 3, c.FLOAT, false, 0, 0)
                    }
                    b0 = b8["morphNormal" + b1];
                    if (b0 >= 0 && ca.morphNormals) {
                        c.bindBuffer(c.ARRAY_BUFFER, b5.__webglMorphNormalsBuffers[b6]);
                        ah(b0);
                        c.vertexAttribPointer(b0, 3, c.FLOAT, false, 0, 0)
                    }
                    b4.__webglMorphTargetInfluences[b1] = cc[b6]
                } else {
                    b4.__webglMorphTargetInfluences[b1] = 0
                }
            }
        }
        if (ca.program.uniforms.morphTargetInfluences !== null) {
            c.uniform1fv(ca.program.uniforms.morphTargetInfluences, b4.__webglMorphTargetInfluences)
        }
    }

    function aC(b1, b0) {
        if (b1.material.id !== b0.material.id) {
            return b1.material.id - b0.material.id
        } else {
            if (b1.z !== b0.z) {
                return b1.z - b0.z
            } else {
                return b1.id - b0.id
            }
        }
    }

    function bj(b1, b0) {
        if (b1.z !== b0.z) {
            return b0.z - b1.z
        } else {
            return b1.id - b0.id
        }
    }

    function ac(b1, b0) {
        return b0[0] - b1[0]
    }
    this.render = function(b4, b8, b5, b6) {
        if (b8 instanceof THREE.Camera === false) {
            console.error("THREE.WebGLRenderer.render: camera is not an instance of THREE.Camera.");
            return
        }
        var b0 = b4.fog;
        aA = "";
        aZ = -1;
        aH = null;
        bZ = true;
        if (b4.autoUpdate === true) {
            b4.updateMatrixWorld()
        }
        if (b8.parent === undefined) {
            b8.updateMatrixWorld()
        }
        b4.traverse(function(ca) {
            if (ca instanceof THREE.SkinnedMesh) {
                ca.skeleton.update()
            }
        });
        b8.matrixWorldInverse.getInverse(b8.matrixWorld);
        aW.multiplyMatrices(b8.projectionMatrix, b8.matrixWorldInverse);
        br.setFromMatrix(aW);
        bI.length = 0;
        bv.length = 0;
        A.length = 0;
        ad.length = 0;
        Q.length = 0;
        at(b4);
        if (aK.sortObjects === true) {
            bv.sort(aC);
            A.sort(bj)
        }
        l.render(b4, b8);
        aK.info.render.calls = 0;
        aK.info.render.vertices = 0;
        aK.info.render.faces = 0;
        aK.info.render.points = 0;
        this.setRenderTarget(b5);
        if (this.autoClear || b6) {
            this.clear(this.autoClearColor, this.autoClearDepth, this.autoClearStencil)
        }
        for (var b2 = 0, b9 = o.length; b2 < b9; b2++) {
            var b3 = o[b2];
            var b1 = b3.object;
            if (b1.visible) {
                bd(b1, b8);
                aN(b3)
            }
        }
        if (b4.overrideMaterial) {
            var b7 = b4.overrideMaterial;
            this.setBlending(b7.blending, b7.blendEquation, b7.blendSrc, b7.blendDst);
            this.setDepthTest(b7.depthTest);
            this.setDepthWrite(b7.depthWrite);
            bW(b7.polygonOffset, b7.polygonOffsetFactor, b7.polygonOffsetUnits);
            bs(bv, b8, bI, b0, true, b7);
            bs(A, b8, bI, b0, true, b7);
            bG(o, "", b8, bI, b0, false, b7)
        } else {
            var b7 = null;
            this.setBlending(THREE.NoBlending);
            bs(bv, b8, bI, b0, false, b7);
            bG(o, "opaque", b8, bI, b0, false, b7);
            bs(A, b8, bI, b0, true, b7);
            bG(o, "transparent", b8, bI, b0, true, b7)
        }
        be.render(b4, b8);
        bK.render(b4, b8, D, aP);
        if (b5 && b5.generateMipmaps && b5.minFilter !== THREE.NearestFilter && b5.minFilter !== THREE.LinearFilter) {
            aS(b5)
        }
        this.setDepthTest(true);
        this.setDepthWrite(true)
    };

    function at(b1) {
        if (b1.visible === false) {
            return
        }
        if (b1 instanceof THREE.Scene || b1 instanceof THREE.Group) {} else {
            E(b1);
            if (b1 instanceof THREE.Light) {
                bI.push(b1)
            } else {
                if (b1 instanceof THREE.Sprite) {
                    ad.push(b1)
                } else {
                    if (b1 instanceof THREE.LensFlare) {
                        Q.push(b1)
                    } else {
                        var b3 = s[b1.id];
                        if (b3 && (b1.frustumCulled === false || br.intersectsObject(b1) === true)) {
                            for (var b2 = 0, b0 = b3.length; b2 < b0; b2++) {
                                var b4 = b3[b2];
                                ap(b4);
                                b4.render = true;
                                if (aK.sortObjects === true) {
                                    U.setFromMatrixPosition(b1.matrixWorld);
                                    U.applyProjection(aW);
                                    b4.z = U.z
                                }
                            }
                        }
                    }
                }
            }
        }
        for (var b2 = 0, b0 = b1.children.length; b2 < b0; b2++) {
            at(b1.children[b2])
        }
    }

    function bs(b0, b9, b5, b1, b8, cb) {
        var ca;
        for (var b6 = 0, b2 = b0.length; b6 < b2; b6++) {
            var b7 = b0[b6];
            var b3 = b7.object;
            var b4 = b7.buffer;
            bd(b3, b9);
            if (cb) {
                ca = cb
            } else {
                ca = b7.material;
                if (!ca) {
                    continue
                }
                if (b8) {
                    aK.setBlending(ca.blending, ca.blendEquation, ca.blendSrc, ca.blendDst)
                }
                aK.setDepthTest(ca.depthTest);
                aK.setDepthWrite(ca.depthWrite);
                bW(ca.polygonOffset, ca.polygonOffsetFactor, ca.polygonOffsetUnits)
            }
            aK.setMaterialFaces(ca);
            if (b4 instanceof THREE.BufferGeometry) {
                aK.renderBufferDirect(b9, b5, b1, ca, b4, b3)
            } else {
                aK.renderBuffer(b9, b5, b1, ca, b4, b3)
            }
        }
    }

    function bG(b0, b7, b9, b4, b1, b8, cb) {
        var ca;
        for (var b5 = 0, b2 = b0.length; b5 < b2; b5++) {
            var b6 = b0[b5];
            var b3 = b6.object;
            if (b3.visible) {
                if (cb) {
                    ca = cb
                } else {
                    ca = b6[b7];
                    if (!ca) {
                        continue
                    }
                    if (b8) {
                        aK.setBlending(ca.blending, ca.blendEquation, ca.blendSrc, ca.blendDst)
                    }
                    aK.setDepthTest(ca.depthTest);
                    aK.setDepthWrite(ca.depthWrite);
                    bW(ca.polygonOffset, ca.polygonOffsetFactor, ca.polygonOffsetUnits)
                }
                aK.renderImmediateObject(b9, b4, b1, ca, b3)
            }
        }
    }
    this.renderImmediateObject = function(b4, b2, b5, b3, b1) {
        var b0 = aM(b4, b2, b5, b3, b1);
        aA = "";
        aK.setMaterialFaces(b3);
        if (b1.immediateRenderCallback) {
            b1.immediateRenderCallback(b0, c, br)
        } else {
            b1.render(function(b6) {
                aK.renderBufferImmediate(b6, b0, b3)
            })
        }
    };

    function aN(b2) {
        var b0 = b2.object,
            b1 = b0.material;
        if (b1.transparent) {
            b2.transparent = b1;
            b2.opaque = null
        } else {
            b2.opaque = b1;
            b2.transparent = null
        }
    }

    function ap(b4) {
        var b2 = b4.object;
        var b1 = b4.buffer;
        var b5 = b2.geometry;
        var b3 = b2.material;
        if (b3 instanceof THREE.MeshFaceMaterial) {
            var b0 = b5 instanceof THREE.BufferGeometry ? 0 : b1.materialIndex;
            b3 = b3.materials[b0];
            b4.material = b3;
            if (b3.transparent) {
                A.push(b4)
            } else {
                bv.push(b4)
            }
        } else {
            if (b3) {
                b4.material = b3;
                if (b3.transparent) {
                    A.push(b4)
                } else {
                    bv.push(b4)
                }
            }
        }
    }

    function E(b2) {
        if (b2.__webglInit === undefined) {
            b2.__webglInit = true;
            b2._modelViewMatrix = new THREE.Matrix4();
            b2._normalMatrix = new THREE.Matrix3();
            b2.addEventListener("removed", bN)
        }
        var b4 = b2.geometry;
        if (b4 === undefined) {} else {
            if (b4.__webglInit === undefined) {
                b4.__webglInit = true;
                b4.addEventListener("dispose", aV);
                if (b4 instanceof THREE.BufferGeometry) {
                    aK.info.memory.geometries++
                } else {
                    if (b2 instanceof THREE.Mesh) {
                        bh(b2, b4)
                    } else {
                        if (b2 instanceof THREE.Line) {
                            if (b4.__webglVertexBuffer === undefined) {
                                ae(b4);
                                J(b4, b2);
                                b4.verticesNeedUpdate = true;
                                b4.colorsNeedUpdate = true;
                                b4.lineDistancesNeedUpdate = true
                            }
                        } else {
                            if (b2 instanceof THREE.PointCloud) {
                                if (b4.__webglVertexBuffer === undefined) {
                                    G(b4);
                                    bF(b4, b2);
                                    b4.verticesNeedUpdate = true;
                                    b4.colorsNeedUpdate = true
                                }
                            }
                        }
                    }
                }
            }
        }
        if (b2.__webglActive === undefined) {
            b2.__webglActive = true;
            if (b2 instanceof THREE.Mesh) {
                if (b4 instanceof THREE.BufferGeometry) {
                    H(s, b4, b2)
                } else {
                    if (b4 instanceof THREE.Geometry) {
                        var b0 = C[b4.id];
                        for (var b3 = 0, b1 = b0.length; b3 < b1; b3++) {
                            H(s, b0[b3], b2)
                        }
                    }
                }
            } else {
                if (b2 instanceof THREE.Line || b2 instanceof THREE.PointCloud) {
                    H(s, b4, b2)
                } else {
                    if (b2 instanceof THREE.ImmediateRenderObject || b2.immediateRenderCallback) {
                        az(o, b2)
                    }
                }
            }
        }
    }
    var C = {};
    var bk = 0;

    function aY(b8, cd) {
        var b5 = a2.get("OES_element_index_uint") ? 4294967296 : 65535;
        var b2, b6 = {};
        var cb = b8.morphTargets.length;
        var b1 = b8.morphNormals.length;
        var cc;
        var b0 = {};
        var b3 = [];
        for (var b4 = 0, ca = b8.faces.length; b4 < ca; b4++) {
            var b7 = b8.faces[b4];
            var b9 = cd ? b7.materialIndex : 0;
            if (!(b9 in b6)) {
                b6[b9] = {
                    hash: b9,
                    counter: 0
                }
            }
            b2 = b6[b9].hash + "_" + b6[b9].counter;
            if (!(b2 in b0)) {
                cc = {
                    id: bk++,
                    faces3: [],
                    materialIndex: b9,
                    vertices: 0,
                    numMorphTargets: cb,
                    numMorphNormals: b1
                };
                b0[b2] = cc;
                b3.push(cc)
            }
            if (b0[b2].vertices + 3 > b5) {
                b6[b9].counter += 1;
                b2 = b6[b9].hash + "_" + b6[b9].counter;
                if (!(b2 in b0)) {
                    cc = {
                        id: bk++,
                        faces3: [],
                        materialIndex: b9,
                        vertices: 0,
                        numMorphTargets: cb,
                        numMorphNormals: b1
                    };
                    b0[b2] = cc;
                    b3.push(cc)
                }
            }
            b0[b2].faces3.push(b4);
            b0[b2].vertices += 3
        }
        return b3
    }

    function bh(b4, b7) {
        var b6 = b4.material,
            b3 = false;
        if (C[b7.id] === undefined || b7.groupsNeedUpdate === true) {
            delete s[b4.id];
            C[b7.id] = aY(b7, b6 instanceof THREE.MeshFaceMaterial);
            b7.groupsNeedUpdate = false
        }
        var b0 = C[b7.id];
        for (var b5 = 0, b2 = b0.length; b5 < b2; b5++) {
            var b1 = b0[b5];
            if (b1.__webglVertexBuffer === undefined) {
                aB(b1);
                ak(b1, b4);
                b7.verticesNeedUpdate = true;
                b7.morphTargetsNeedUpdate = true;
                b7.elementsNeedUpdate = true;
                b7.uvsNeedUpdate = true;
                b7.normalsNeedUpdate = true;
                b7.tangentsNeedUpdate = true;
                b7.colorsNeedUpdate = true;
                b3 = true
            } else {
                b3 = false
            }
            if (b3 || b4.__webglActive === undefined) {
                H(s, b1, b4)
            }
        }
        b4.__webglActive = true
    }

    function H(b2, b0, b1) {
        var b3 = b1.id;
        b2[b3] = b2[b3] || [];
        b2[b3].push({
            id: b3,
            buffer: b0,
            object: b1,
            material: null,
            z: 0
        })
    }

    function az(b1, b0) {
        b1.push({
            id: null,
            object: b0,
            opaque: null,
            transparent: null,
            z: 0
        })
    }

    function L(b3) {
        var b8 = b3.geometry;
        if (b8 instanceof THREE.BufferGeometry) {
            var b4 = b8.attributes;
            var cd = b8.attributesKeys;
            for (var b5 = 0, b1 = cd.length; b5 < b1; b5++) {
                var cb = cd[b5];
                var b0 = b4[cb];
                if (b0.buffer === undefined) {
                    b0.buffer = c.createBuffer();
                    b0.needsUpdate = true
                }
                if (b0.needsUpdate === true) {
                    var cc = (cb === "index") ? c.ELEMENT_ARRAY_BUFFER : c.ARRAY_BUFFER;
                    c.bindBuffer(cc, b0.buffer);
                    c.bufferData(cc, b0.array, c.STATIC_DRAW);
                    b0.needsUpdate = false
                }
            }
        } else {
            if (b3 instanceof THREE.Mesh) {
                if (b8.groupsNeedUpdate === true) {
                    bh(b3, b8)
                }
                var b7 = C[b8.id];
                for (var b5 = 0, b9 = b7.length; b5 < b9; b5++) {
                    var b2 = b7[b5];
                    var b6 = K(b3, b2);
                    if (b8.groupsNeedUpdate === true) {
                        ak(b2, b3)
                    }
                    var ca = b6.attributes && f(b6);
                    if (b8.verticesNeedUpdate || b8.morphTargetsNeedUpdate || b8.elementsNeedUpdate || b8.uvsNeedUpdate || b8.normalsNeedUpdate || b8.colorsNeedUpdate || b8.tangentsNeedUpdate || ca) {
                        k(b2, b3, c.DYNAMIC_DRAW, !b8.dynamic, b6)
                    }
                }
                b8.verticesNeedUpdate = false;
                b8.morphTargetsNeedUpdate = false;
                b8.elementsNeedUpdate = false;
                b8.uvsNeedUpdate = false;
                b8.normalsNeedUpdate = false;
                b8.colorsNeedUpdate = false;
                b8.tangentsNeedUpdate = false;
                b6.attributes && au(b6)
            } else {
                if (b3 instanceof THREE.Line) {
                    var b6 = K(b3, b8);
                    var ca = b6.attributes && f(b6);
                    if (b8.verticesNeedUpdate || b8.colorsNeedUpdate || b8.lineDistancesNeedUpdate || ca) {
                        bn(b8, c.DYNAMIC_DRAW)
                    }
                    b8.verticesNeedUpdate = false;
                    b8.colorsNeedUpdate = false;
                    b8.lineDistancesNeedUpdate = false;
                    b6.attributes && au(b6)
                } else {
                    if (b3 instanceof THREE.PointCloud) {
                        var b6 = K(b3, b8);
                        var ca = b6.attributes && f(b6);
                        if (b8.verticesNeedUpdate || b8.colorsNeedUpdate || ca) {
                            a5(b8, c.DYNAMIC_DRAW, b3)
                        }
                        b8.verticesNeedUpdate = false;
                        b8.colorsNeedUpdate = false;
                        b6.attributes && au(b6)
                    }
                }
            }
        }
    }

    function f(b1) {
        for (var b0 in b1.attributes) {
            if (b1.attributes[b0].needsUpdate) {
                return true
            }
        }
        return false
    }

    function au(b1) {
        for (var b0 in b1.attributes) {
            b1.attributes[b0].needsUpdate = false
        }
    }

    function N(b0) {
        if (b0 instanceof THREE.Mesh || b0 instanceof THREE.PointCloud || b0 instanceof THREE.Line) {
            delete s[b0.id]
        } else {
            if (b0 instanceof THREE.ImmediateRenderObject || b0.immediateRenderCallback) {
                bX(o, b0)
            }
        }
        delete b0.__webglInit;
        delete b0._modelViewMatrix;
        delete b0._normalMatrix;
        delete b0.__webglActive
    }

    function bX(b1, b0) {
        for (var b2 = b1.length - 1; b2 >= 0; b2--) {
            if (b1[b2].object === b0) {
                b1.splice(b2, 1)
            }
        }
    }
    var aG = {
        MeshDepthMaterial: "depth",
        MeshNormalMaterial: "normal",
        MeshBasicMaterial: "basic",
        MeshLambertMaterial: "lambert",
        MeshPhongMaterial: "phong",
        LineBasicMaterial: "basic",
        LineDashedMaterial: "dashed",
        PointCloudMaterial: "particle_basic"
    };

    function bC(cc, cj, b1, cl) {
        cc.addEventListener("dispose", bf);
        var b7 = aG[cc.type];
        if (b7) {
            var b0 = THREE.ShaderLib[b7];
            cc.__webglShader = {
                uniforms: THREE.UniformsUtils.clone(b0.uniforms),
                vertexShader: b0.vertexShader,
                fragmentShader: b0.fragmentShader
            }
        } else {
            cc.__webglShader = {
                uniforms: cc.uniforms,
                vertexShader: cc.vertexShader,
                fragmentShader: cc.fragmentShader
            }
        }
        var cf = bc(cj);
        var b6 = aa(cj);
        var ck = aE(cl);
        var b8 = {
            precision: i,
            supportsVertexTextures: aR,
            map: !!cc.map,
            envMap: !!cc.envMap,
            envMapMode: cc.envMap && cc.envMap.mapping,
            lightMap: !!cc.lightMap,
            bumpMap: !!cc.bumpMap,
            normalMap: !!cc.normalMap,
            specularMap: !!cc.specularMap,
            alphaMap: !!cc.alphaMap,
            combine: cc.combine,
            vertexColors: cc.vertexColors,
            fog: b1,
            useFog: cc.fog,
            fogExp: b1 instanceof THREE.FogExp2,
            sizeAttenuation: cc.sizeAttenuation,
            logarithmicDepthBuffer: t,
            skinning: cc.skinning,
            maxBones: ck,
            useVertexTexture: Z && cl && cl.skeleton && cl.skeleton.useVertexTexture,
            morphTargets: cc.morphTargets,
            morphNormals: cc.morphNormals,
            maxMorphTargets: aK.maxMorphTargets,
            maxMorphNormals: aK.maxMorphNormals,
            maxDirLights: cf.directional,
            maxPointLights: cf.point,
            maxSpotLights: cf.spot,
            maxHemiLights: cf.hemi,
            maxShadows: b6,
            shadowMapEnabled: aK.shadowMapEnabled && cl.receiveShadow && b6 > 0,
            shadowMapType: aK.shadowMapType,
            shadowMapDebug: aK.shadowMapDebug,
            shadowMapCascade: aK.shadowMapCascade,
            alphaTest: cc.alphaTest,
            metal: cc.metal,
            wrapAround: cc.wrapAround,
            doubleSided: cc.side === THREE.DoubleSide,
            flipSided: cc.side === THREE.BackSide
        };
        var cd = [];
        if (b7) {
            cd.push(b7)
        } else {
            cd.push(cc.fragmentShader);
            cd.push(cc.vertexShader)
        }
        if (cc.defines !== undefined) {
            for (var cm in cc.defines) {
                cd.push(cm);
                cd.push(cc.defines[cm])
            }
        }
        for (var cm in b8) {
            cd.push(cm);
            cd.push(b8[cm])
        }
        var b3 = cd.join();
        var ca;
        for (var cg = 0, ci = by.length; cg < ci; cg++) {
            var b5 = by[cg];
            if (b5.code === b3) {
                ca = b5;
                ca.usedTimes++;
                break
            }
        }
        if (ca === undefined) {
            ca = new THREE.WebGLProgram(aK, b3, cc, b8);
            by.push(ca);
            aK.info.memory.programs = by.length
        }
        cc.program = ca;
        var b9 = ca.attributes;
        if (cc.morphTargets) {
            cc.numSupportedMorphTargets = 0;
            var ce, b4 = "morphTarget";
            for (var ch = 0; ch < aK.maxMorphTargets; ch++) {
                ce = b4 + ch;
                if (b9[ce] >= 0) {
                    cc.numSupportedMorphTargets++
                }
            }
        }
        if (cc.morphNormals) {
            cc.numSupportedMorphNormals = 0;
            var ce, b4 = "morphNormal";
            for (ch = 0; ch < aK.maxMorphNormals; ch++) {
                ce = b4 + ch;
                if (b9[ce] >= 0) {
                    cc.numSupportedMorphNormals++
                }
            }
        }
        cc.uniformsList = [];
        for (var cb in cc.__webglShader.uniforms) {
            var b2 = cc.program.uniforms[cb];
            if (b2) {
                cc.uniformsList.push([cc.__webglShader.uniforms[cb], b2])
            }
        }
    }

    function aM(b7, b4, b0, b8, b3) {
        bb = 0;
        if (b8.needsUpdate) {
            if (b8.program) {
                R(b8)
            }
            bC(b8, b4, b0, b3);
            b8.needsUpdate = false
        }
        if (b8.morphTargets) {
            if (!b3.__webglMorphTargetInfluences) {
                b3.__webglMorphTargetInfluences = new Float32Array(aK.maxMorphTargets)
            }
        }
        var b2 = false;
        var b6 = false;
        var b1 = false;
        var b5 = b8.program,
            cb = b5.uniforms,
            b9 = b8.__webglShader.uniforms;
        if (b5.id !== al) {
            c.useProgram(b5.program);
            al = b5.id;
            b2 = true;
            b6 = true;
            b1 = true
        }
        if (b8.id !== aZ) {
            if (aZ === -1) {
                b1 = true
            }
            aZ = b8.id;
            b6 = true
        }
        if (b2 || b7 !== aH) {
            c.uniformMatrix4fv(cb.projectionMatrix, false, b7.projectionMatrix.elements);
            if (t) {
                c.uniform1f(cb.logDepthBufFC, 2 / (Math.log(b7.far + 1) / Math.LN2))
            }
            if (b7 !== aH) {
                aH = b7
            }
            if (b8 instanceof THREE.ShaderMaterial || b8 instanceof THREE.MeshPhongMaterial || b8.envMap) {
                if (cb.cameraPosition !== null) {
                    U.setFromMatrixPosition(b7.matrixWorld);
                    c.uniform3f(cb.cameraPosition, U.x, U.y, U.z)
                }
            }
            if (b8 instanceof THREE.MeshPhongMaterial || b8 instanceof THREE.MeshLambertMaterial || b8 instanceof THREE.MeshBasicMaterial || b8 instanceof THREE.ShaderMaterial || b8.skinning) {
                if (cb.viewMatrix !== null) {
                    c.uniformMatrix4fv(cb.viewMatrix, false, b7.matrixWorldInverse.elements)
                }
            }
        }
        if (b8.skinning) {
            if (b3.bindMatrix && cb.bindMatrix !== null) {
                c.uniformMatrix4fv(cb.bindMatrix, false, b3.bindMatrix.elements)
            }
            if (b3.bindMatrixInverse && cb.bindMatrixInverse !== null) {
                c.uniformMatrix4fv(cb.bindMatrixInverse, false, b3.bindMatrixInverse.elements)
            }
            if (Z && b3.skeleton && b3.skeleton.useVertexTexture) {
                if (cb.boneTexture !== null) {
                    var ca = av();
                    c.uniform1i(cb.boneTexture, ca);
                    aK.setTexture(b3.skeleton.boneTexture, ca)
                }
                if (cb.boneTextureWidth !== null) {
                    c.uniform1i(cb.boneTextureWidth, b3.skeleton.boneTextureWidth)
                }
                if (cb.boneTextureHeight !== null) {
                    c.uniform1i(cb.boneTextureHeight, b3.skeleton.boneTextureHeight)
                }
            } else {
                if (b3.skeleton && b3.skeleton.boneMatrices) {
                    if (cb.boneGlobalMatrices !== null) {
                        c.uniformMatrix4fv(cb.boneGlobalMatrices, false, b3.skeleton.boneMatrices)
                    }
                }
            }
        }
        if (b6) {
            if (b0 && b8.fog) {
                ab(b9, b0)
            }
            if (b8 instanceof THREE.MeshPhongMaterial || b8 instanceof THREE.MeshLambertMaterial || b8.lights) {
                if (bZ) {
                    b1 = true;
                    d(b4);
                    bZ = false
                }
                if (b1) {
                    a9(b9, bp);
                    P(b9, true)
                } else {
                    P(b9, false)
                }
            }
            if (b8 instanceof THREE.MeshBasicMaterial || b8 instanceof THREE.MeshLambertMaterial || b8 instanceof THREE.MeshPhongMaterial) {
                bB(b9, b8)
            }
            if (b8 instanceof THREE.LineBasicMaterial) {
                aq(b9, b8)
            } else {
                if (b8 instanceof THREE.LineDashedMaterial) {
                    aq(b9, b8);
                    af(b9, b8)
                } else {
                    if (b8 instanceof THREE.PointCloudMaterial) {
                        bo(b9, b8)
                    } else {
                        if (b8 instanceof THREE.MeshPhongMaterial) {
                            O(b9, b8)
                        } else {
                            if (b8 instanceof THREE.MeshLambertMaterial) {
                                bD(b9, b8)
                            } else {
                                if (b8 instanceof THREE.MeshDepthMaterial) {
                                    b9.mNear.value = b7.near;
                                    b9.mFar.value = b7.far;
                                    b9.opacity.value = b8.opacity
                                } else {
                                    if (b8 instanceof THREE.MeshNormalMaterial) {
                                        b9.opacity.value = b8.opacity
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (b3.receiveShadow && !b8._shadowPass) {
                bM(b9, b4)
            }
            T(b8.uniformsList)
        }
        u(cb, b3);
        if (cb.modelMatrix !== null) {
            c.uniformMatrix4fv(cb.modelMatrix, false, b3.matrixWorld.elements)
        }
        return b5
    }

    function bB(b1, b2) {
        b1.opacity.value = b2.opacity;
        if (aK.gammaInput) {
            b1.diffuse.value.copyGammaToLinear(b2.color)
        } else {
            b1.diffuse.value = b2.color
        }
        b1.map.value = b2.map;
        b1.lightMap.value = b2.lightMap;
        b1.specularMap.value = b2.specularMap;
        b1.alphaMap.value = b2.alphaMap;
        if (b2.bumpMap) {
            b1.bumpMap.value = b2.bumpMap;
            b1.bumpScale.value = b2.bumpScale
        }
        if (b2.normalMap) {
            b1.normalMap.value = b2.normalMap;
            b1.normalScale.value.copy(b2.normalScale)
        }
        var b0;
        if (b2.map) {
            b0 = b2.map
        } else {
            if (b2.specularMap) {
                b0 = b2.specularMap
            } else {
                if (b2.normalMap) {
                    b0 = b2.normalMap
                } else {
                    if (b2.bumpMap) {
                        b0 = b2.bumpMap
                    } else {
                        if (b2.alphaMap) {
                            b0 = b2.alphaMap
                        }
                    }
                }
            }
        }
        if (b0 !== undefined) {
            var b4 = b0.offset;
            var b3 = b0.repeat;
            b1.offsetRepeat.value.set(b4.x, b4.y, b3.x, b3.y)
        }
        b1.envMap.value = b2.envMap;
        b1.flipEnvMap.value = (b2.envMap instanceof THREE.WebGLRenderTargetCube) ? 1 : -1;
        if (aK.gammaInput) {
            b1.reflectivity.value = b2.reflectivity
        } else {
            b1.reflectivity.value = b2.reflectivity
        }
        b1.refractionRatio.value = b2.refractionRatio
    }

    function aq(b0, b1) {
        b0.diffuse.value = b1.color;
        b0.opacity.value = b1.opacity
    }

    function af(b0, b1) {
        b0.dashSize.value = b1.dashSize;
        b0.totalSize.value = b1.dashSize + b1.gapSize;
        b0.scale.value = b1.scale
    }

    function bo(b0, b1) {
        b0.psColor.value = b1.color;
        b0.opacity.value = b1.opacity;
        b0.size.value = b1.size;
        b0.scale.value = aU.height / 2;
        b0.map.value = b1.map
    }

    function ab(b0, b1) {
        b0.fogColor.value = b1.color;
        if (b1 instanceof THREE.Fog) {
            b0.fogNear.value = b1.near;
            b0.fogFar.value = b1.far
        } else {
            if (b1 instanceof THREE.FogExp2) {
                b0.fogDensity.value = b1.density
            }
        }
    }

    function O(b0, b1) {
        b0.shininess.value = b1.shininess;
        if (aK.gammaInput) {
            b0.ambient.value.copyGammaToLinear(b1.ambient);
            b0.emissive.value.copyGammaToLinear(b1.emissive);
            b0.specular.value.copyGammaToLinear(b1.specular)
        } else {
            b0.ambient.value = b1.ambient;
            b0.emissive.value = b1.emissive;
            b0.specular.value = b1.specular
        }
        if (b1.wrapAround) {
            b0.wrapRGB.value.copy(b1.wrapRGB)
        }
    }

    function bD(b0, b1) {
        if (aK.gammaInput) {
            b0.ambient.value.copyGammaToLinear(b1.ambient);
            b0.emissive.value.copyGammaToLinear(b1.emissive)
        } else {
            b0.ambient.value = b1.ambient;
            b0.emissive.value = b1.emissive
        }
        if (b1.wrapAround) {
            b0.wrapRGB.value.copy(b1.wrapRGB)
        }
    }

    function a9(b0, b1) {
        b0.ambientLightColor.value = b1.ambient;
        b0.directionalLightColor.value = b1.directional.colors;
        b0.directionalLightDirection.value = b1.directional.positions;
        b0.pointLightColor.value = b1.point.colors;
        b0.pointLightPosition.value = b1.point.positions;
        b0.pointLightDistance.value = b1.point.distances;
        b0.spotLightColor.value = b1.spot.colors;
        b0.spotLightPosition.value = b1.spot.positions;
        b0.spotLightDistance.value = b1.spot.distances;
        b0.spotLightDirection.value = b1.spot.directions;
        b0.spotLightAngleCos.value = b1.spot.anglesCos;
        b0.spotLightExponent.value = b1.spot.exponents;
        b0.hemisphereLightSkyColor.value = b1.hemi.skyColors;
        b0.hemisphereLightGroundColor.value = b1.hemi.groundColors;
        b0.hemisphereLightDirection.value = b1.hemi.positions
    }

    function P(b0, b1) {
        b0.ambientLightColor.needsUpdate = b1;
        b0.directionalLightColor.needsUpdate = b1;
        b0.directionalLightDirection.needsUpdate = b1;
        b0.pointLightColor.needsUpdate = b1;
        b0.pointLightPosition.needsUpdate = b1;
        b0.pointLightDistance.needsUpdate = b1;
        b0.spotLightColor.needsUpdate = b1;
        b0.spotLightPosition.needsUpdate = b1;
        b0.spotLightDistance.needsUpdate = b1;
        b0.spotLightDirection.needsUpdate = b1;
        b0.spotLightAngleCos.needsUpdate = b1;
        b0.spotLightExponent.needsUpdate = b1;
        b0.hemisphereLightSkyColor.needsUpdate = b1;
        b0.hemisphereLightGroundColor.needsUpdate = b1;
        b0.hemisphereLightDirection.needsUpdate = b1
    }

    function bM(b0, b4) {
        if (b0.shadowMatrix) {
            var b3 = 0;
            for (var b5 = 0, b2 = b4.length; b5 < b2; b5++) {
                var b1 = b4[b5];
                if (!b1.castShadow) {
                    continue
                }
                if (b1 instanceof THREE.SpotLight || (b1 instanceof THREE.DirectionalLight && !b1.shadowCascade)) {
                    b0.shadowMap.value[b3] = b1.shadowMap;
                    b0.shadowMapSize.value[b3] = b1.shadowMapSize;
                    b0.shadowMatrix.value[b3] = b1.shadowMatrix;
                    b0.shadowDarkness.value[b3] = b1.shadowDarkness;
                    b0.shadowBias.value[b3] = b1.shadowBias;
                    b3++
                }
            }
        }
    }

    function u(b0, b1) {
        c.uniformMatrix4fv(b0.modelViewMatrix, false, b1._modelViewMatrix.elements);
        if (b0.normalMatrix) {
            c.uniformMatrix3fv(b0.normalMatrix, false, b1._normalMatrix.elements)
        }
    }

    function av() {
        var b0 = bb;
        if (b0 >= bE) {
            console.warn("WebGLRenderer: trying to use " + b0 + " texture units while this GPU supports only " + bE)
        }
        bb += 1;
        return b0
    }

    function T(ca) {
        var b5, cb, b1;
        for (var b2 = 0, b4 = ca.length; b2 < b4; b2++) {
            var b0 = ca[b2][0];
            if (b0.needsUpdate === false) {
                continue
            }
            var b6 = b0.type;
            var b9 = b0.value;
            var b8 = ca[b2][1];
            switch (b6) {
                case "1i":
                    c.uniform1i(b8, b9);
                    break;
                case "1f":
                    c.uniform1f(b8, b9);
                    break;
                case "2f":
                    c.uniform2f(b8, b9[0], b9[1]);
                    break;
                case "3f":
                    c.uniform3f(b8, b9[0], b9[1], b9[2]);
                    break;
                case "4f":
                    c.uniform4f(b8, b9[0], b9[1], b9[2], b9[3]);
                    break;
                case "1iv":
                    c.uniform1iv(b8, b9);
                    break;
                case "3iv":
                    c.uniform3iv(b8, b9);
                    break;
                case "1fv":
                    c.uniform1fv(b8, b9);
                    break;
                case "2fv":
                    c.uniform2fv(b8, b9);
                    break;
                case "3fv":
                    c.uniform3fv(b8, b9);
                    break;
                case "4fv":
                    c.uniform4fv(b8, b9);
                    break;
                case "Matrix3fv":
                    c.uniformMatrix3fv(b8, false, b9);
                    break;
                case "Matrix4fv":
                    c.uniformMatrix4fv(b8, false, b9);
                    break;
                case "i":
                    c.uniform1i(b8, b9);
                    break;
                case "f":
                    c.uniform1f(b8, b9);
                    break;
                case "v2":
                    c.uniform2f(b8, b9.x, b9.y);
                    break;
                case "v3":
                    c.uniform3f(b8, b9.x, b9.y, b9.z);
                    break;
                case "v4":
                    c.uniform4f(b8, b9.x, b9.y, b9.z, b9.w);
                    break;
                case "c":
                    c.uniform3f(b8, b9.r, b9.g, b9.b);
                    break;
                case "iv1":
                    c.uniform1iv(b8, b9);
                    break;
                case "iv":
                    c.uniform3iv(b8, b9);
                    break;
                case "fv1":
                    c.uniform1fv(b8, b9);
                    break;
                case "fv":
                    c.uniform3fv(b8, b9);
                    break;
                case "v2v":
                    if (b0._array === undefined) {
                        b0._array = new Float32Array(2 * b9.length)
                    }
                    for (var b3 = 0, b7 = b9.length; b3 < b7; b3++) {
                        b1 = b3 * 2;
                        b0._array[b1] = b9[b3].x;
                        b0._array[b1 + 1] = b9[b3].y
                    }
                    c.uniform2fv(b8, b0._array);
                    break;
                case "v3v":
                    if (b0._array === undefined) {
                        b0._array = new Float32Array(3 * b9.length)
                    }
                    for (var b3 = 0, b7 = b9.length; b3 < b7; b3++) {
                        b1 = b3 * 3;
                        b0._array[b1] = b9[b3].x;
                        b0._array[b1 + 1] = b9[b3].y;
                        b0._array[b1 + 2] = b9[b3].z
                    }
                    c.uniform3fv(b8, b0._array);
                    break;
                case "v4v":
                    if (b0._array === undefined) {
                        b0._array = new Float32Array(4 * b9.length)
                    }
                    for (var b3 = 0, b7 = b9.length; b3 < b7; b3++) {
                        b1 = b3 * 4;
                        b0._array[b1] = b9[b3].x;
                        b0._array[b1 + 1] = b9[b3].y;
                        b0._array[b1 + 2] = b9[b3].z;
                        b0._array[b1 + 3] = b9[b3].w
                    }
                    c.uniform4fv(b8, b0._array);
                    break;
                case "m3":
                    c.uniformMatrix3fv(b8, false, b9.elements);
                    break;
                case "m3v":
                    if (b0._array === undefined) {
                        b0._array = new Float32Array(9 * b9.length)
                    }
                    for (var b3 = 0, b7 = b9.length; b3 < b7; b3++) {
                        b9[b3].flattenToArrayOffset(b0._array, b3 * 9)
                    }
                    c.uniformMatrix3fv(b8, false, b0._array);
                    break;
                case "m4":
                    c.uniformMatrix4fv(b8, false, b9.elements);
                    break;
                case "m4v":
                    if (b0._array === undefined) {
                        b0._array = new Float32Array(16 * b9.length)
                    }
                    for (var b3 = 0, b7 = b9.length; b3 < b7; b3++) {
                        b9[b3].flattenToArrayOffset(b0._array, b3 * 16)
                    }
                    c.uniformMatrix4fv(b8, false, b0._array);
                    break;
                case "t":
                    b5 = b9;
                    cb = av();
                    c.uniform1i(b8, cb);
                    if (!b5) {
                        continue
                    }
                    if (b5 instanceof THREE.CubeTexture || (b5.image instanceof Array && b5.image.length === 6)) {
                        bl(b5, cb)
                    } else {
                        if (b5 instanceof THREE.WebGLRenderTargetCube) {
                            a7(b5, cb)
                        } else {
                            aK.setTexture(b5, cb)
                        }
                    }
                    break;
                case "tv":
                    if (b0._array === undefined) {
                        b0._array = []
                    }
                    for (var b3 = 0, b7 = b0.value.length; b3 < b7; b3++) {
                        b0._array[b3] = av()
                    }
                    c.uniform1iv(b8, b0._array);
                    for (var b3 = 0, b7 = b0.value.length; b3 < b7; b3++) {
                        b5 = b0.value[b3];
                        cb = b0._array[b3];
                        if (!b5) {
                            continue
                        }
                        aK.setTexture(b5, cb)
                    }
                    break;
                default:
                    console.warn("THREE.WebGLRenderer: Unknown uniform type: " + b6)
            }
        }
    }

    function bd(b0, b1) {
        b0._modelViewMatrix.multiplyMatrices(b1.matrixWorldInverse, b0.matrixWorld);
        b0._normalMatrix.getNormalMatrix(b0._modelViewMatrix)
    }

    function a3(b3, b2, b0, b1) {
        b3[b2] = b0.r * b0.r * b1;
        b3[b2 + 1] = b0.g * b0.g * b1;
        b3[b2 + 2] = b0.b * b0.b * b1
    }

    function a4(b3, b2, b1, b0) {
        b3[b2] = b1.r * b0;
        b3[b2 + 1] = b1.g * b0;
        b3[b2 + 2] = b1.b * b0
    }

    function d(b4) {
        var cC, cq, ch, cy, ct = 0,
            cD = 0,
            cE = 0,
            co, b1, b8, cp, b7, cs, cf, cl = bp,
            cd = cl.directional.colors,
            b2 = cl.directional.positions,
            cz = cl.point.colors,
            cv = cl.point.positions,
            cn = cl.point.distances,
            cA = cl.spot.colors,
            b3 = cl.spot.positions,
            cw = cl.spot.distances,
            cc = cl.spot.directions,
            b5 = cl.spot.anglesCos,
            ce = cl.spot.exponents,
            b0 = cl.hemi.skyColors,
            cB = cl.hemi.groundColors,
            cb = cl.hemi.positions,
            cF = 0,
            ck = 0,
            cg = 0,
            b9 = 0,
            cm = 0,
            cj = 0,
            ci = 0,
            b6 = 0,
            ca = 0,
            cx = 0,
            cu = 0,
            cr = 0;
        for (cC = 0, cq = b4.length; cC < cq; cC++) {
            ch = b4[cC];
            if (ch.onlyShadow) {
                continue
            }
            co = ch.color;
            cp = ch.intensity;
            cf = ch.distance;
            if (ch instanceof THREE.AmbientLight) {
                if (!ch.visible) {
                    continue
                }
                if (aK.gammaInput) {
                    ct += co.r * co.r;
                    cD += co.g * co.g;
                    cE += co.b * co.b
                } else {
                    ct += co.r;
                    cD += co.g;
                    cE += co.b
                }
            } else {
                if (ch instanceof THREE.DirectionalLight) {
                    cm += 1;
                    if (!ch.visible) {
                        continue
                    }
                    aI.setFromMatrixPosition(ch.matrixWorld);
                    U.setFromMatrixPosition(ch.target.matrixWorld);
                    aI.sub(U);
                    aI.normalize();
                    ca = cF * 3;
                    b2[ca] = aI.x;
                    b2[ca + 1] = aI.y;
                    b2[ca + 2] = aI.z;
                    if (aK.gammaInput) {
                        a3(cd, ca, co, cp * cp)
                    } else {
                        a4(cd, ca, co, cp)
                    }
                    cF += 1
                } else {
                    if (ch instanceof THREE.PointLight) {
                        cj += 1;
                        if (!ch.visible) {
                            continue
                        }
                        cx = ck * 3;
                        if (aK.gammaInput) {
                            a3(cz, cx, co, cp * cp)
                        } else {
                            a4(cz, cx, co, cp)
                        }
                        U.setFromMatrixPosition(ch.matrixWorld);
                        cv[cx] = U.x;
                        cv[cx + 1] = U.y;
                        cv[cx + 2] = U.z;
                        cn[ck] = cf;
                        ck += 1
                    } else {
                        if (ch instanceof THREE.SpotLight) {
                            ci += 1;
                            if (!ch.visible) {
                                continue
                            }
                            cu = cg * 3;
                            if (aK.gammaInput) {
                                a3(cA, cu, co, cp * cp)
                            } else {
                                a4(cA, cu, co, cp)
                            }
                            aI.setFromMatrixPosition(ch.matrixWorld);
                            b3[cu] = aI.x;
                            b3[cu + 1] = aI.y;
                            b3[cu + 2] = aI.z;
                            cw[cg] = cf;
                            U.setFromMatrixPosition(ch.target.matrixWorld);
                            aI.sub(U);
                            aI.normalize();
                            cc[cu] = aI.x;
                            cc[cu + 1] = aI.y;
                            cc[cu + 2] = aI.z;
                            b5[cg] = Math.cos(ch.angle);
                            ce[cg] = ch.exponent;
                            cg += 1
                        } else {
                            if (ch instanceof THREE.HemisphereLight) {
                                b6 += 1;
                                if (!ch.visible) {
                                    continue
                                }
                                aI.setFromMatrixPosition(ch.matrixWorld);
                                aI.normalize();
                                cr = b9 * 3;
                                cb[cr] = aI.x;
                                cb[cr + 1] = aI.y;
                                cb[cr + 2] = aI.z;
                                b1 = ch.color;
                                b8 = ch.groundColor;
                                if (aK.gammaInput) {
                                    b7 = cp * cp;
                                    a3(b0, cr, b1, b7);
                                    a3(cB, cr, b8, b7)
                                } else {
                                    a4(b0, cr, b1, cp);
                                    a4(cB, cr, b8, cp)
                                }
                                b9 += 1
                            }
                        }
                    }
                }
            }
        }
        for (cC = cF * 3, cq = Math.max(cd.length, cm * 3); cC < cq; cC++) {
            cd[cC] = 0
        }
        for (cC = ck * 3, cq = Math.max(cz.length, cj * 3); cC < cq; cC++) {
            cz[cC] = 0
        }
        for (cC = cg * 3, cq = Math.max(cA.length, ci * 3); cC < cq; cC++) {
            cA[cC] = 0
        }
        for (cC = b9 * 3, cq = Math.max(b0.length, b6 * 3); cC < cq; cC++) {
            b0[cC] = 0
        }
        for (cC = b9 * 3, cq = Math.max(cB.length, b6 * 3); cC < cq; cC++) {
            cB[cC] = 0
        }
        cl.directional.length = cF;
        cl.point.length = ck;
        cl.spot.length = cg;
        cl.hemi.length = b9;
        cl.ambient[0] = ct;
        cl.ambient[1] = cD;
        cl.ambient[2] = cE
    }
    this.setFaceCulling = function(b1, b0) {
        if (b1 === THREE.CullFaceNone) {
            c.disable(c.CULL_FACE)
        } else {
            if (b0 === THREE.FrontFaceDirectionCW) {
                c.frontFace(c.CW)
            } else {
                c.frontFace(c.CCW)
            }
            if (b1 === THREE.CullFaceBack) {
                c.cullFace(c.BACK)
            } else {
                if (b1 === THREE.CullFaceFront) {
                    c.cullFace(c.FRONT)
                } else {
                    c.cullFace(c.FRONT_AND_BACK)
                }
            }
            c.enable(c.CULL_FACE)
        }
    };
    this.setMaterialFaces = function(b2) {
        var b0 = b2.side === THREE.DoubleSide;
        var b1 = b2.side === THREE.BackSide;
        if (bi !== b0) {
            if (b0) {
                c.disable(c.CULL_FACE)
            } else {
                c.enable(c.CULL_FACE)
            }
            bi = b0
        }
        if (j !== b1) {
            if (b1) {
                c.frontFace(c.CW)
            } else {
                c.frontFace(c.CCW)
            }
            j = b1
        }
    };
    this.setDepthTest = function(b0) {
        if (a !== b0) {
            if (b0) {
                c.enable(c.DEPTH_TEST)
            } else {
                c.disable(c.DEPTH_TEST)
            }
            a = b0
        }
    };
    this.setDepthWrite = function(b0) {
        if (bu !== b0) {
            c.depthMask(b0);
            bu = b0
        }
    };

    function aD(b0) {
        b0 *= n;
        if (b0 !== bm) {
            c.lineWidth(b0);
            bm = b0
        }
    }

    function bW(b2, b1, b0) {
        if (aF !== b2) {
            if (b2) {
                c.enable(c.POLYGON_OFFSET_FILL)
            } else {
                c.disable(c.POLYGON_OFFSET_FILL)
            }
            aF = b2
        }
        if (b2 && (bL !== b1 || a8 !== b0)) {
            c.polygonOffset(b1, b0);
            bL = b1;
            a8 = b0
        }
    }
    this.setBlending = function(b1, b0, b2, b3) {
        if (b1 !== h) {
            if (b1 === THREE.NoBlending) {
                c.disable(c.BLEND)
            } else {
                if (b1 === THREE.AdditiveBlending) {
                    c.enable(c.BLEND);
                    c.blendEquation(c.FUNC_ADD);
                    c.blendFunc(c.SRC_ALPHA, c.ONE)
                } else {
                    if (b1 === THREE.SubtractiveBlending) {
                        c.enable(c.BLEND);
                        c.blendEquation(c.FUNC_ADD);
                        c.blendFunc(c.ZERO, c.ONE_MINUS_SRC_COLOR)
                    } else {
                        if (b1 === THREE.MultiplyBlending) {
                            c.enable(c.BLEND);
                            c.blendEquation(c.FUNC_ADD);
                            c.blendFunc(c.ZERO, c.SRC_COLOR)
                        } else {
                            if (b1 === THREE.CustomBlending) {
                                c.enable(c.BLEND)
                            } else {
                                c.enable(c.BLEND);
                                c.blendEquationSeparate(c.FUNC_ADD, c.FUNC_ADD);
                                c.blendFuncSeparate(c.SRC_ALPHA, c.ONE_MINUS_SRC_ALPHA, c.ONE, c.ONE_MINUS_SRC_ALPHA)
                            }
                        }
                    }
                }
            }
            h = b1
        }
        if (b1 === THREE.CustomBlending) {
            if (b0 !== ai) {
                c.blendEquation(aO(b0));
                ai = b0
            }
            if (b2 !== bO || b3 !== ar) {
                c.blendFunc(aO(b2), aO(b3));
                bO = b2;
                ar = b3
            }
        } else {
            ai = null;
            bO = null;
            ar = null
        }
    };

    function aj(b0, b1, b2) {
        var b3;
        if (b2) {
            c.texParameteri(b0, c.TEXTURE_WRAP_S, aO(b1.wrapS));
            c.texParameteri(b0, c.TEXTURE_WRAP_T, aO(b1.wrapT));
            c.texParameteri(b0, c.TEXTURE_MAG_FILTER, aO(b1.magFilter));
            c.texParameteri(b0, c.TEXTURE_MIN_FILTER, aO(b1.minFilter))
        } else {
            c.texParameteri(b0, c.TEXTURE_WRAP_S, c.CLAMP_TO_EDGE);
            c.texParameteri(b0, c.TEXTURE_WRAP_T, c.CLAMP_TO_EDGE);
            if (b1.wrapS !== THREE.ClampToEdgeWrapping || b1.wrapT !== THREE.ClampToEdgeWrapping) {
                console.warn("THREE.WebGLRenderer: Texture is not power of two. Texture.wrapS and Texture.wrapT is set to THREE.ClampToEdgeWrapping. ( " + b1.sourceFile + " )")
            }
            c.texParameteri(b0, c.TEXTURE_MAG_FILTER, aL(b1.magFilter));
            c.texParameteri(b0, c.TEXTURE_MIN_FILTER, aL(b1.minFilter));
            if (b1.minFilter !== THREE.NearestFilter && b1.minFilter !== THREE.LinearFilter) {
                console.warn("THREE.WebGLRenderer: Texture is not power of two. Texture.minFilter is set to THREE.LinearFilter or THREE.NearestFilter. ( " + b1.sourceFile + " )")
            }
        }
        b3 = a2.get("EXT_texture_filter_anisotropic");
        if (b3 && b1.type !== THREE.FloatType) {
            if (b1.anisotropy > 1 || b1.__oldAnisotropy) {
                c.texParameterf(b0, b3.TEXTURE_MAX_ANISOTROPY_EXT, Math.min(b1.anisotropy, aK.getMaxAnisotropy()));
                b1.__oldAnisotropy = b1.anisotropy
            }
        }
    }
    this.uploadTexture = function(b7) {
        if (b7.__webglInit === undefined) {
            b7.__webglInit = true;
            b7.addEventListener("dispose", ag);
            b7.__webglTexture = c.createTexture();
            aK.info.memory.textures++
        }
        c.bindTexture(c.TEXTURE_2D, b7.__webglTexture);
        c.pixelStorei(c.UNPACK_FLIP_Y_WEBGL, b7.flipY);
        c.pixelStorei(c.UNPACK_PREMULTIPLY_ALPHA_WEBGL, b7.premultiplyAlpha);
        c.pixelStorei(c.UNPACK_ALIGNMENT, b7.unpackAlignment);
        b7.image = q(b7.image, B);
        var b3 = b7.image,
            b6 = THREE.Math.isPowerOfTwo(b3.width) && THREE.Math.isPowerOfTwo(b3.height),
            b0 = aO(b7.format),
            b2 = aO(b7.type);
        aj(c.TEXTURE_2D, b7, b6);
        var b1, b4 = b7.mipmaps;
        if (b7 instanceof THREE.DataTexture) {
            if (b4.length > 0 && b6) {
                for (var b5 = 0, b8 = b4.length; b5 < b8; b5++) {
                    b1 = b4[b5];
                    c.texImage2D(c.TEXTURE_2D, b5, b0, b1.width, b1.height, 0, b0, b2, b1.data)
                }
                b7.generateMipmaps = false
            } else {
                c.texImage2D(c.TEXTURE_2D, 0, b0, b3.width, b3.height, 0, b0, b2, b3.data)
            }
        } else {
            if (b7 instanceof THREE.CompressedTexture) {
                for (var b5 = 0, b8 = b4.length; b5 < b8; b5++) {
                    b1 = b4[b5];
                    if (b7.format !== THREE.RGBAFormat && b7.format !== THREE.RGBFormat) {
                        if (X().indexOf(b0) > -1) {
                            c.compressedTexImage2D(c.TEXTURE_2D, b5, b0, b1.width, b1.height, 0, b1.data)
                        } else {
                            console.warn("Attempt to load unsupported compressed texture format")
                        }
                    } else {
                        c.texImage2D(c.TEXTURE_2D, b5, b0, b1.width, b1.height, 0, b0, b2, b1.data)
                    }
                }
            } else {
                if (b4.length > 0 && b6) {
                    for (var b5 = 0, b8 = b4.length; b5 < b8; b5++) {
                        b1 = b4[b5];
                        c.texImage2D(c.TEXTURE_2D, b5, b0, b0, b2, b1)
                    }
                    b7.generateMipmaps = false
                } else {
                    c.texImage2D(c.TEXTURE_2D, 0, b0, b0, b2, b7.image)
                }
            }
        }
        if (b7.generateMipmaps && b6) {
            c.generateMipmap(c.TEXTURE_2D)
        }
        b7.needsUpdate = false;
        if (b7.onUpdate) {
            b7.onUpdate()
        }
    };
    this.setTexture = function(b0, b1) {
        c.activeTexture(c.TEXTURE0 + b1);
        if (b0.needsUpdate) {
            aK.uploadTexture(b0)
        } else {
            c.bindTexture(c.TEXTURE_2D, b0.__webglTexture)
        }
    };

    function q(b2, b4) {
        if (b2.width > b4 || b2.height > b4) {
            var b3 = b4 / Math.max(b2.width, b2.height);
            var b0 = document.createElement("canvas");
            b0.width = Math.floor(b2.width * b3);
            b0.height = Math.floor(b2.height * b3);
            var b1 = b0.getContext("2d");
            b1.drawImage(b2, 0, 0, b2.width, b2.height, 0, 0, b0.width, b0.height);
            return b0
        }
        return b2
    }

    function bl(cc, cd) {
        if (cc.image.length === 6) {
            if (cc.needsUpdate) {
                if (!cc.image.__webglTextureCube) {
                    cc.addEventListener("dispose", ag);
                    cc.image.__webglTextureCube = c.createTexture();
                    aK.info.memory.textures++
                }
                c.activeTexture(c.TEXTURE0 + cd);
                c.bindTexture(c.TEXTURE_CUBE_MAP, cc.image.__webglTextureCube);
                c.pixelStorei(c.UNPACK_FLIP_Y_WEBGL, cc.flipY);
                var b4 = cc instanceof THREE.CompressedTexture;
                var b3 = cc.image[0] instanceof THREE.DataTexture;
                var b0 = [];
                for (var ca = 0; ca < 6; ca++) {
                    if (aK.autoScaleCubemaps && !b4 && !b3) {
                        b0[ca] = q(cc.image[ca], an)
                    } else {
                        b0[ca] = b3 ? cc.image[ca].image : cc.image[ca]
                    }
                }
                var b7 = b0[0],
                    cb = THREE.Math.isPowerOfTwo(b7.width) && THREE.Math.isPowerOfTwo(b7.height),
                    b1 = aO(cc.format),
                    b5 = aO(cc.type);
                aj(c.TEXTURE_CUBE_MAP, cc, cb);
                for (var ca = 0; ca < 6; ca++) {
                    if (!b4) {
                        if (b3) {
                            c.texImage2D(c.TEXTURE_CUBE_MAP_POSITIVE_X + ca, 0, b1, b0[ca].width, b0[ca].height, 0, b1, b5, b0[ca].data)
                        } else {
                            c.texImage2D(c.TEXTURE_CUBE_MAP_POSITIVE_X + ca, 0, b1, b1, b5, b0[ca])
                        }
                    } else {
                        var b2, b6 = b0[ca].mipmaps;
                        for (var b8 = 0, b9 = b6.length; b8 < b9; b8++) {
                            b2 = b6[b8];
                            if (cc.format !== THREE.RGBAFormat && cc.format !== THREE.RGBFormat) {
                                if (X().indexOf(b1) > -1) {
                                    c.compressedTexImage2D(c.TEXTURE_CUBE_MAP_POSITIVE_X + ca, b8, b1, b2.width, b2.height, 0, b2.data)
                                } else {
                                    console.warn("Attempt to load unsupported compressed texture format")
                                }
                            } else {
                                c.texImage2D(c.TEXTURE_CUBE_MAP_POSITIVE_X + ca, b8, b1, b2.width, b2.height, 0, b1, b5, b2.data)
                            }
                        }
                    }
                }
                if (cc.generateMipmaps && cb) {
                    c.generateMipmap(c.TEXTURE_CUBE_MAP)
                }
                cc.needsUpdate = false;
                if (cc.onUpdate) {
                    cc.onUpdate()
                }
            } else {
                c.activeTexture(c.TEXTURE0 + cd);
                c.bindTexture(c.TEXTURE_CUBE_MAP, cc.image.__webglTextureCube)
            }
        }
    }

    function a7(b0, b1) {
        c.activeTexture(c.TEXTURE0 + b1);
        c.bindTexture(c.TEXTURE_CUBE_MAP, b0.__webglTexture)
    }

    function a6(b2, b1, b0) {
        c.bindFramebuffer(c.FRAMEBUFFER, b2);
        c.framebufferTexture2D(c.FRAMEBUFFER, c.COLOR_ATTACHMENT0, b0, b1.__webglTexture, 0)
    }

    function p(b0, b1) {
        c.bindRenderbuffer(c.RENDERBUFFER, b0);
        if (b1.depthBuffer && !b1.stencilBuffer) {
            c.renderbufferStorage(c.RENDERBUFFER, c.DEPTH_COMPONENT16, b1.width, b1.height);
            c.framebufferRenderbuffer(c.FRAMEBUFFER, c.DEPTH_ATTACHMENT, c.RENDERBUFFER, b0)
        } else {
            if (b1.depthBuffer && b1.stencilBuffer) {
                c.renderbufferStorage(c.RENDERBUFFER, c.DEPTH_STENCIL, b1.width, b1.height);
                c.framebufferRenderbuffer(c.FRAMEBUFFER, c.DEPTH_STENCIL_ATTACHMENT, c.RENDERBUFFER, b0)
            } else {
                c.renderbufferStorage(c.RENDERBUFFER, c.RGBA4, b1.width, b1.height)
            }
        }
    }
    this.setRenderTarget = function(b4) {
        var b6 = (b4 instanceof THREE.WebGLRenderTargetCube);
        if (b4 && b4.__webglFramebuffer === undefined) {
            if (b4.depthBuffer === undefined) {
                b4.depthBuffer = true
            }
            if (b4.stencilBuffer === undefined) {
                b4.stencilBuffer = true
            }
            b4.addEventListener("dispose", S);
            b4.__webglTexture = c.createTexture();
            aK.info.memory.textures++;
            var b7 = THREE.Math.isPowerOfTwo(b4.width) && THREE.Math.isPowerOfTwo(b4.height),
                b0 = aO(b4.format),
                b2 = aO(b4.type);
            if (b6) {
                b4.__webglFramebuffer = [];
                b4.__webglRenderbuffer = [];
                c.bindTexture(c.TEXTURE_CUBE_MAP, b4.__webglTexture);
                aj(c.TEXTURE_CUBE_MAP, b4, b7);
                for (var b3 = 0; b3 < 6; b3++) {
                    b4.__webglFramebuffer[b3] = c.createFramebuffer();
                    b4.__webglRenderbuffer[b3] = c.createRenderbuffer();
                    c.texImage2D(c.TEXTURE_CUBE_MAP_POSITIVE_X + b3, 0, b0, b4.width, b4.height, 0, b0, b2, null);
                    a6(b4.__webglFramebuffer[b3], b4, c.TEXTURE_CUBE_MAP_POSITIVE_X + b3);
                    p(b4.__webglRenderbuffer[b3], b4)
                }
                if (b7) {
                    c.generateMipmap(c.TEXTURE_CUBE_MAP)
                }
            } else {
                b4.__webglFramebuffer = c.createFramebuffer();
                if (b4.shareDepthFrom) {
                    b4.__webglRenderbuffer = b4.shareDepthFrom.__webglRenderbuffer
                } else {
                    b4.__webglRenderbuffer = c.createRenderbuffer()
                }
                c.bindTexture(c.TEXTURE_2D, b4.__webglTexture);
                aj(c.TEXTURE_2D, b4, b7);
                c.texImage2D(c.TEXTURE_2D, 0, b0, b4.width, b4.height, 0, b0, b2, null);
                a6(b4.__webglFramebuffer, b4, c.TEXTURE_2D);
                if (b4.shareDepthFrom) {
                    if (b4.depthBuffer && !b4.stencilBuffer) {
                        c.framebufferRenderbuffer(c.FRAMEBUFFER, c.DEPTH_ATTACHMENT, c.RENDERBUFFER, b4.__webglRenderbuffer)
                    } else {
                        if (b4.depthBuffer && b4.stencilBuffer) {
                            c.framebufferRenderbuffer(c.FRAMEBUFFER, c.DEPTH_STENCIL_ATTACHMENT, c.RENDERBUFFER, b4.__webglRenderbuffer)
                        }
                    }
                } else {
                    p(b4.__webglRenderbuffer, b4)
                }
                if (b7) {
                    c.generateMipmap(c.TEXTURE_2D)
                }
            }
            if (b6) {
                c.bindTexture(c.TEXTURE_CUBE_MAP, null)
            } else {
                c.bindTexture(c.TEXTURE_2D, null)
            }
            c.bindRenderbuffer(c.RENDERBUFFER, null);
            c.bindFramebuffer(c.FRAMEBUFFER, null)
        }
        var b9, b1, ca, b8, b5;
        if (b4) {
            if (b6) {
                b9 = b4.__webglFramebuffer[b4.activeCubeFace]
            } else {
                b9 = b4.__webglFramebuffer
            }
            b1 = b4.width;
            ca = b4.height;
            b8 = 0;
            b5 = 0
        } else {
            b9 = null;
            b1 = bQ;
            ca = aQ;
            b8 = a1;
            b5 = a0
        }
        if (b9 !== bA) {
            c.bindFramebuffer(c.FRAMEBUFFER, b9);
            c.viewport(b8, b5, b1, ca);
            bA = b9
        }
        D = b1;
        aP = ca
    };

    function aS(b0) {
        if (b0 instanceof THREE.WebGLRenderTargetCube) {
            c.bindTexture(c.TEXTURE_CUBE_MAP, b0.__webglTexture);
            c.generateMipmap(c.TEXTURE_CUBE_MAP);
            c.bindTexture(c.TEXTURE_CUBE_MAP, null)
        } else {
            c.bindTexture(c.TEXTURE_2D, b0.__webglTexture);
            c.generateMipmap(c.TEXTURE_2D);
            c.bindTexture(c.TEXTURE_2D, null)
        }
    }

    function aL(b0) {
        if (b0 === THREE.NearestFilter || b0 === THREE.NearestMipMapNearestFilter || b0 === THREE.NearestMipMapLinearFilter) {
            return c.NEAREST
        }
        return c.LINEAR
    }

    function aO(b0) {
        var b1;
        if (b0 === THREE.RepeatWrapping) {
            return c.REPEAT
        }
        if (b0 === THREE.ClampToEdgeWrapping) {
            return c.CLAMP_TO_EDGE
        }
        if (b0 === THREE.MirroredRepeatWrapping) {
            return c.MIRRORED_REPEAT
        }
        if (b0 === THREE.NearestFilter) {
            return c.NEAREST
        }
        if (b0 === THREE.NearestMipMapNearestFilter) {
            return c.NEAREST_MIPMAP_NEAREST
        }
        if (b0 === THREE.NearestMipMapLinearFilter) {
            return c.NEAREST_MIPMAP_LINEAR
        }
        if (b0 === THREE.LinearFilter) {
            return c.LINEAR
        }
        if (b0 === THREE.LinearMipMapNearestFilter) {
            return c.LINEAR_MIPMAP_NEAREST
        }
        if (b0 === THREE.LinearMipMapLinearFilter) {
            return c.LINEAR_MIPMAP_LINEAR
        }
        if (b0 === THREE.UnsignedByteType) {
            return c.UNSIGNED_BYTE
        }
        if (b0 === THREE.UnsignedShort4444Type) {
            return c.UNSIGNED_SHORT_4_4_4_4
        }
        if (b0 === THREE.UnsignedShort5551Type) {
            return c.UNSIGNED_SHORT_5_5_5_1
        }
        if (b0 === THREE.UnsignedShort565Type) {
            return c.UNSIGNED_SHORT_5_6_5
        }
        if (b0 === THREE.ByteType) {
            return c.BYTE
        }
        if (b0 === THREE.ShortType) {
            return c.SHORT
        }
        if (b0 === THREE.UnsignedShortType) {
            return c.UNSIGNED_SHORT
        }
        if (b0 === THREE.IntType) {
            return c.INT
        }
        if (b0 === THREE.UnsignedIntType) {
            return c.UNSIGNED_INT
        }
        if (b0 === THREE.FloatType) {
            return c.FLOAT
        }
        if (b0 === THREE.AlphaFormat) {
            return c.ALPHA
        }
        if (b0 === THREE.RGBFormat) {
            return c.RGB
        }
        if (b0 === THREE.RGBAFormat) {
            return c.RGBA
        }
        if (b0 === THREE.LuminanceFormat) {
            return c.LUMINANCE
        }
        if (b0 === THREE.LuminanceAlphaFormat) {
            return c.LUMINANCE_ALPHA
        }
        if (b0 === THREE.AddEquation) {
            return c.FUNC_ADD
        }
        if (b0 === THREE.SubtractEquation) {
            return c.FUNC_SUBTRACT
        }
        if (b0 === THREE.ReverseSubtractEquation) {
            return c.FUNC_REVERSE_SUBTRACT
        }
        if (b0 === THREE.ZeroFactor) {
            return c.ZERO
        }
        if (b0 === THREE.OneFactor) {
            return c.ONE
        }
        if (b0 === THREE.SrcColorFactor) {
            return c.SRC_COLOR
        }
        if (b0 === THREE.OneMinusSrcColorFactor) {
            return c.ONE_MINUS_SRC_COLOR
        }
        if (b0 === THREE.SrcAlphaFactor) {
            return c.SRC_ALPHA
        }
        if (b0 === THREE.OneMinusSrcAlphaFactor) {
            return c.ONE_MINUS_SRC_ALPHA
        }
        if (b0 === THREE.DstAlphaFactor) {
            return c.DST_ALPHA
        }
        if (b0 === THREE.OneMinusDstAlphaFactor) {
            return c.ONE_MINUS_DST_ALPHA
        }
        if (b0 === THREE.DstColorFactor) {
            return c.DST_COLOR
        }
        if (b0 === THREE.OneMinusDstColorFactor) {
            return c.ONE_MINUS_DST_COLOR
        }
        if (b0 === THREE.SrcAlphaSaturateFactor) {
            return c.SRC_ALPHA_SATURATE
        }
        b1 = a2.get("WEBGL_compressed_texture_s3tc");
        if (b1 !== null) {
            if (b0 === THREE.RGB_S3TC_DXT1_Format) {
                return b1.COMPRESSED_RGB_S3TC_DXT1_EXT
            }
            if (b0 === THREE.RGBA_S3TC_DXT1_Format) {
                return b1.COMPRESSED_RGBA_S3TC_DXT1_EXT
            }
            if (b0 === THREE.RGBA_S3TC_DXT3_Format) {
                return b1.COMPRESSED_RGBA_S3TC_DXT3_EXT
            }
            if (b0 === THREE.RGBA_S3TC_DXT5_Format) {
                return b1.COMPRESSED_RGBA_S3TC_DXT5_EXT
            }
        }
        b1 = a2.get("WEBGL_compressed_texture_pvrtc");
        if (b1 !== null) {
            if (b0 === THREE.RGB_PVRTC_4BPPV1_Format) {
                return b1.COMPRESSED_RGB_PVRTC_4BPPV1_IMG
            }
            if (b0 === THREE.RGB_PVRTC_2BPPV1_Format) {
                return b1.COMPRESSED_RGB_PVRTC_2BPPV1_IMG
            }
            if (b0 === THREE.RGBA_PVRTC_4BPPV1_Format) {
                return b1.COMPRESSED_RGBA_PVRTC_4BPPV1_IMG
            }
            if (b0 === THREE.RGBA_PVRTC_2BPPV1_Format) {
                return b1.COMPRESSED_RGBA_PVRTC_2BPPV1_IMG
            }
        }
        b1 = a2.get("EXT_blend_minmax");
        if (b1 !== null) {
            if (b0 === THREE.MinEquation) {
                return b1.MIN_EXT
            }
            if (b0 === THREE.MaxEquation) {
                return b1.MAX_EXT
            }
        }
        return 0
    }

    function aE(b3) {
        if (Z && b3 && b3.skeleton && b3.skeleton.useVertexTexture) {
            return 1024
        } else {
            var b1 = c.getParameter(c.MAX_VERTEX_UNIFORM_VECTORS);
            var b2 = Math.floor((b1 - 20) / 4);
            var b0 = b2;
            if (b3 !== undefined && b3 instanceof THREE.SkinnedMesh) {
                b0 = Math.min(b3.skeleton.bones.length, b0);
                if (b0 < b3.skeleton.bones.length) {
                    console.warn("WebGLRenderer: too many bones - " + b3.skeleton.bones.length + ", this GPU supports just " + b0 + " (try OpenGL instead of ANGLE)")
                }
            }
            return b0
        }
    }

    function bc(b2) {
        var b3 = 0;
        var b7 = 0;
        var b5 = 0;
        var b6 = 0;
        for (var b1 = 0, b4 = b2.length; b1 < b4; b1++) {
            var b0 = b2[b1];
            if (b0.onlyShadow || b0.visible === false) {
                continue
            }
            if (b0 instanceof THREE.DirectionalLight) {
                b3++
            }
            if (b0 instanceof THREE.PointLight) {
                b7++
            }
            if (b0 instanceof THREE.SpotLight) {
                b5++
            }
            if (b0 instanceof THREE.HemisphereLight) {
                b6++
            }
        }
        return {
            directional: b3,
            point: b7,
            spot: b5,
            hemi: b6
        }
    }

    function aa(b2) {
        var b3 = 0;
        for (var b1 = 0, b4 = b2.length; b1 < b4; b1++) {
            var b0 = b2[b1];
            if (!b0.castShadow) {
                continue
            }
            if (b0 instanceof THREE.SpotLight) {
                b3++
            }
            if (b0 instanceof THREE.DirectionalLight && !b0.shadowCascade) {
                b3++
            }
        }
        return b3
    }
    this.initMaterial = function() {
        console.warn("THREE.WebGLRenderer: .initMaterial() has been removed.")
    };
    this.addPrePlugin = function() {
        console.warn("THREE.WebGLRenderer: .addPrePlugin() has been removed.")
    };
    this.addPostPlugin = function() {
        console.warn("THREE.WebGLRenderer: .addPostPlugin() has been removed.")
    };
    this.updateShadowMap = function() {
        console.warn("THREE.WebGLRenderer: .updateShadowMap() has been removed.")
    }
};
THREE.WebGLRenderTarget = function(c, a, b) {
    this.width = c;
    this.height = a;
    b = b || {};
    this.wrapS = b.wrapS !== undefined ? b.wrapS : THREE.ClampToEdgeWrapping;
    this.wrapT = b.wrapT !== undefined ? b.wrapT : THREE.ClampToEdgeWrapping;
    this.magFilter = b.magFilter !== undefined ? b.magFilter : THREE.LinearFilter;
    this.minFilter = b.minFilter !== undefined ? b.minFilter : THREE.LinearMipMapLinearFilter;
    this.anisotropy = b.anisotropy !== undefined ? b.anisotropy : 1;
    this.offset = new THREE.Vector2(0, 0);
    this.repeat = new THREE.Vector2(1, 1);
    this.format = b.format !== undefined ? b.format : THREE.RGBAFormat;
    this.type = b.type !== undefined ? b.type : THREE.UnsignedByteType;
    this.depthBuffer = b.depthBuffer !== undefined ? b.depthBuffer : true;
    this.stencilBuffer = b.stencilBuffer !== undefined ? b.stencilBuffer : true;
    this.generateMipmaps = true;
    this.shareDepthFrom = null
};
THREE.WebGLRenderTarget.prototype = {
    constructor: THREE.WebGLRenderTarget,
    setSize: function(b, a) {
        this.width = b;
        this.height = a
    },
    clone: function() {
        var a = new THREE.WebGLRenderTarget(this.width, this.height);
        a.wrapS = this.wrapS;
        a.wrapT = this.wrapT;
        a.magFilter = this.magFilter;
        a.minFilter = this.minFilter;
        a.anisotropy = this.anisotropy;
        a.offset.copy(this.offset);
        a.repeat.copy(this.repeat);
        a.format = this.format;
        a.type = this.type;
        a.depthBuffer = this.depthBuffer;
        a.stencilBuffer = this.stencilBuffer;
        a.generateMipmaps = this.generateMipmaps;
        a.shareDepthFrom = this.shareDepthFrom;
        return a
    },
    dispose: function() {
        this.dispatchEvent({
            type: "dispose"
        })
    }
};
THREE.EventDispatcher.prototype.apply(THREE.WebGLRenderTarget.prototype);
THREE.WebGLRenderTargetCube = function(c, a, b) {
    THREE.WebGLRenderTarget.call(this, c, a, b);
    this.activeCubeFace = 0
};
THREE.WebGLRenderTargetCube.prototype = Object.create(THREE.WebGLRenderTarget.prototype);
THREE.WebGLRenderTargetCube.prototype.constructor = THREE.WebGLRenderTargetCube;
THREE.WebGLExtensions = function(b) {
    var a = {};
    this.get = function(c) {
        if (a[c] !== undefined) {
            return a[c]
        }
        var d;
        switch (c) {
            case "EXT_texture_filter_anisotropic":
                d = b.getExtension("EXT_texture_filter_anisotropic") || b.getExtension("MOZ_EXT_texture_filter_anisotropic") || b.getExtension("WEBKIT_EXT_texture_filter_anisotropic");
                break;
            case "WEBGL_compressed_texture_s3tc":
                d = b.getExtension("WEBGL_compressed_texture_s3tc") || b.getExtension("MOZ_WEBGL_compressed_texture_s3tc") || b.getExtension("WEBKIT_WEBGL_compressed_texture_s3tc");
                break;
            case "WEBGL_compressed_texture_pvrtc":
                d = b.getExtension("WEBGL_compressed_texture_pvrtc") || b.getExtension("WEBKIT_WEBGL_compressed_texture_pvrtc");
                break;
            default:
                d = b.getExtension(c)
        }
        if (d === null) {}
        a[c] = d;
        return d
    }
};
THREE.WebGLProgram = (function() {
    var b = 0;
    var c = function(f) {
        var g, e, i = [];
        for (var h in f) {
            g = f[h];
            if (g === false) {
                continue
            }
            e = "#define " + h + " " + g;
            i.push(e)
        }
        return i.join("\n")
    };
    var d = function(k, h, f) {
        var e = {};
        for (var j = 0, g = f.length; j < g; j++) {
            var m = f[j];
            e[m] = k.getUniformLocation(h, m)
        }
        return e
    };
    var a = function(k, h, e) {
        var g = {};
        for (var j = 0, f = e.length; j < f; j++) {
            var m = e[j];
            g[m] = k.getAttribLocation(h, m)
        }
        return g
    };
    return function(A, f, v, p) {
        var C = A;
        var q = C.context;
        var F = v.defines;
        var I = v.__webglShader.uniforms;
        var s = v.attributes;
        var l = v.__webglShader.vertexShader;
        var e = v.__webglShader.fragmentShader;
        var G = v.index0AttributeName;
        if (G === undefined && p.morphTargets === true) {
            G = "position"
        }
        var h = "SHADOWMAP_TYPE_BASIC";
        if (p.shadowMapType === THREE.PCFShadowMap) {
            h = "SHADOWMAP_TYPE_PCF"
        } else {
            if (p.shadowMapType === THREE.PCFSoftShadowMap) {
                h = "SHADOWMAP_TYPE_PCF_SOFT"
            }
        }
        var H = "ENVMAP_TYPE_CUBE";
        var B = "ENVMAP_MODE_REFLECTION";
        var g = "ENVMAP_BLENDING_MULTIPLY";
        if (p.envMap) {
            switch (v.envMap.mapping) {
                case THREE.CubeReflectionMapping:
                case THREE.CubeRefractionMapping:
                    H = "ENVMAP_TYPE_CUBE";
                    break;
                case THREE.EquirectangularReflectionMapping:
                case THREE.EquirectangularRefractionMapping:
                    H = "ENVMAP_TYPE_EQUIREC";
                    break;
                case THREE.SphericalReflectionMapping:
                    H = "ENVMAP_TYPE_SPHERE";
                    break
            }
            switch (v.envMap.mapping) {
                case THREE.CubeRefractionMapping:
                case THREE.EquirectangularRefractionMapping:
                    B = "ENVMAP_MODE_REFRACTION";
                    break
            }
            switch (v.combine) {
                case THREE.MultiplyOperation:
                    g = "ENVMAP_BLENDING_MULTIPLY";
                    break;
                case THREE.MixOperation:
                    g = "ENVMAP_BLENDING_MIX";
                    break;
                case THREE.AddOperation:
                    g = "ENVMAP_BLENDING_ADD";
                    break
            }
        }
        var k = c(F);
        var r = q.createProgram();
        var j, n;
        if (v instanceof THREE.RawShaderMaterial) {
            j = "";
            n = ""
        } else {
            j = ["precision " + p.precision + " float;", "precision " + p.precision + " int;", k, p.supportsVertexTextures ? "#define VERTEX_TEXTURES" : "", C.gammaInput ? "#define GAMMA_INPUT" : "", C.gammaOutput ? "#define GAMMA_OUTPUT" : "", "#define MAX_DIR_LIGHTS " + p.maxDirLights, "#define MAX_POINT_LIGHTS " + p.maxPointLights, "#define MAX_SPOT_LIGHTS " + p.maxSpotLights, "#define MAX_HEMI_LIGHTS " + p.maxHemiLights, "#define MAX_SHADOWS " + p.maxShadows, "#define MAX_BONES " + p.maxBones, p.map ? "#define USE_MAP" : "", p.envMap ? "#define USE_ENVMAP" : "", p.envMap ? "#define " + B : "", p.lightMap ? "#define USE_LIGHTMAP" : "", p.bumpMap ? "#define USE_BUMPMAP" : "", p.normalMap ? "#define USE_NORMALMAP" : "", p.specularMap ? "#define USE_SPECULARMAP" : "", p.alphaMap ? "#define USE_ALPHAMAP" : "", p.vertexColors ? "#define USE_COLOR" : "", p.skinning ? "#define USE_SKINNING" : "", p.useVertexTexture ? "#define BONE_TEXTURE" : "", p.morphTargets ? "#define USE_MORPHTARGETS" : "", p.morphNormals ? "#define USE_MORPHNORMALS" : "", p.wrapAround ? "#define WRAP_AROUND" : "", p.doubleSided ? "#define DOUBLE_SIDED" : "", p.flipSided ? "#define FLIP_SIDED" : "", p.shadowMapEnabled ? "#define USE_SHADOWMAP" : "", p.shadowMapEnabled ? "#define " + h : "", p.shadowMapDebug ? "#define SHADOWMAP_DEBUG" : "", p.shadowMapCascade ? "#define SHADOWMAP_CASCADE" : "", p.sizeAttenuation ? "#define USE_SIZEATTENUATION" : "", p.logarithmicDepthBuffer ? "#define USE_LOGDEPTHBUF" : "", "uniform mat4 modelMatrix;", "uniform mat4 modelViewMatrix;", "uniform mat4 projectionMatrix;", "uniform mat4 viewMatrix;", "uniform mat3 normalMatrix;", "uniform vec3 cameraPosition;", "attribute vec3 position;", "attribute vec3 normal;", "attribute vec2 uv;", "attribute vec2 uv2;", "#ifdef USE_COLOR", "	attribute vec3 color;", "#endif", "#ifdef USE_MORPHTARGETS", "	attribute vec3 morphTarget0;", "	attribute vec3 morphTarget1;", "	attribute vec3 morphTarget2;", "	attribute vec3 morphTarget3;", "	#ifdef USE_MORPHNORMALS", "		attribute vec3 morphNormal0;", "		attribute vec3 morphNormal1;", "		attribute vec3 morphNormal2;", "		attribute vec3 morphNormal3;", "	#else", "		attribute vec3 morphTarget4;", "		attribute vec3 morphTarget5;", "		attribute vec3 morphTarget6;", "		attribute vec3 morphTarget7;", "	#endif", "#endif", "#ifdef USE_SKINNING", "	attribute vec4 skinIndex;", "	attribute vec4 skinWeight;", "#endif", ""].join("\n");
            n = ["precision " + p.precision + " float;", "precision " + p.precision + " int;", (p.bumpMap || p.normalMap) ? "#extension GL_OES_standard_derivatives : enable" : "", k, "#define MAX_DIR_LIGHTS " + p.maxDirLights, "#define MAX_POINT_LIGHTS " + p.maxPointLights, "#define MAX_SPOT_LIGHTS " + p.maxSpotLights, "#define MAX_HEMI_LIGHTS " + p.maxHemiLights, "#define MAX_SHADOWS " + p.maxShadows, p.alphaTest ? "#define ALPHATEST " + p.alphaTest : "", C.gammaInput ? "#define GAMMA_INPUT" : "", C.gammaOutput ? "#define GAMMA_OUTPUT" : "", (p.useFog && p.fog) ? "#define USE_FOG" : "", (p.useFog && p.fogExp) ? "#define FOG_EXP2" : "", p.map ? "#define USE_MAP" : "", p.envMap ? "#define USE_ENVMAP" : "", p.envMap ? "#define " + H : "", p.envMap ? "#define " + B : "", p.envMap ? "#define " + g : "", p.lightMap ? "#define USE_LIGHTMAP" : "", p.bumpMap ? "#define USE_BUMPMAP" : "", p.normalMap ? "#define USE_NORMALMAP" : "", p.specularMap ? "#define USE_SPECULARMAP" : "", p.alphaMap ? "#define USE_ALPHAMAP" : "", p.vertexColors ? "#define USE_COLOR" : "", p.metal ? "#define METAL" : "", p.wrapAround ? "#define WRAP_AROUND" : "", p.doubleSided ? "#define DOUBLE_SIDED" : "", p.flipSided ? "#define FLIP_SIDED" : "", p.shadowMapEnabled ? "#define USE_SHADOWMAP" : "", p.shadowMapEnabled ? "#define " + h : "", p.shadowMapDebug ? "#define SHADOWMAP_DEBUG" : "", p.shadowMapCascade ? "#define SHADOWMAP_CASCADE" : "", p.logarithmicDepthBuffer ? "#define USE_LOGDEPTHBUF" : "", "uniform mat4 viewMatrix;", "uniform vec3 cameraPosition;", ""].join("\n")
        }
        var m = new THREE.WebGLShader(q, q.VERTEX_SHADER, j + l);
        var D = new THREE.WebGLShader(q, q.FRAGMENT_SHADER, n + e);
        q.attachShader(r, m);
        q.attachShader(r, D);
        if (G !== undefined) {
            q.bindAttribLocation(r, 0, G)
        }
        q.linkProgram(r);
        if (q.getProgramParameter(r, q.LINK_STATUS) === false) {
            console.error("THREE.WebGLProgram: Could not initialise shader.");
            console.error("gl.VALIDATE_STATUS", q.getProgramParameter(r, q.VALIDATE_STATUS));
            console.error("gl.getError()", q.getError())
        }
        if (q.getProgramInfoLog(r) !== "") {
            console.warn("THREE.WebGLProgram: gl.getProgramInfoLog()", q.getProgramInfoLog(r))
        }
        q.deleteShader(m);
        q.deleteShader(D);
        var o = ["viewMatrix", "modelViewMatrix", "projectionMatrix", "normalMatrix", "modelMatrix", "cameraPosition", "morphTargetInfluences", "bindMatrix", "bindMatrixInverse"];
        if (p.useVertexTexture) {
            o.push("boneTexture");
            o.push("boneTextureWidth");
            o.push("boneTextureHeight")
        } else {
            o.push("boneGlobalMatrices")
        }
        if (p.logarithmicDepthBuffer) {
            o.push("logDepthBufFC")
        }
        for (var t in I) {
            o.push(t)
        }
        this.uniforms = d(q, r, o);
        o = ["position", "normal", "uv", "uv2", "tangent", "color", "skinIndex", "skinWeight", "lineDistance"];
        for (var E = 0; E < p.maxMorphTargets; E++) {
            o.push("morphTarget" + E)
        }
        for (var E = 0; E < p.maxMorphNormals; E++) {
            o.push("morphNormal" + E)
        }
        for (var J in s) {
            o.push(J)
        }
        this.attributes = a(q, r, o);
        this.attributesKeys = Object.keys(this.attributes);
        this.id = b++;
        this.code = f;
        this.usedTimes = 1;
        this.program = r;
        this.vertexShader = m;
        this.fragmentShader = D;
        return this
    }
})();
THREE.WebGLShader = (function() {
    var a = function(c) {
        var b = c.split("\n");
        for (var d = 0; d < b.length; d++) {
            b[d] = (d + 1) + ": " + b[d]
        }
        return b.join("\n")
    };
    return function(e, c, b) {
        var d = e.createShader(c);
        e.shaderSource(d, b);
        e.compileShader(d);
        if (e.getShaderParameter(d, e.COMPILE_STATUS) === false) {
            console.error("THREE.WebGLShader: Shader couldn't compile.")
        }
        if (e.getShaderInfoLog(d) !== "") {
            console.warn("THREE.WebGLShader: gl.getShaderInfoLog()", e.getShaderInfoLog(d));
            console.warn(a(b))
        }
        return d
    }
})();
THREE.LensFlarePlugin = function(j, c) {
    var i = j.context;
    var k, a;
    var g, f, l;
    var h;
    var d, e;
    var m = function() {
        var o = new Float32Array([-1, -1, 0, 0, 1, -1, 1, 0, 1, 1, 1, 1, -1, 1, 0, 1]);
        var n = new Uint16Array([0, 1, 2, 0, 2, 3]);
        k = i.createBuffer();
        a = i.createBuffer();
        i.bindBuffer(i.ARRAY_BUFFER, k);
        i.bufferData(i.ARRAY_BUFFER, o, i.STATIC_DRAW);
        i.bindBuffer(i.ELEMENT_ARRAY_BUFFER, a);
        i.bufferData(i.ELEMENT_ARRAY_BUFFER, n, i.STATIC_DRAW);
        d = i.createTexture();
        e = i.createTexture();
        i.bindTexture(i.TEXTURE_2D, d);
        i.texImage2D(i.TEXTURE_2D, 0, i.RGB, 16, 16, 0, i.RGB, i.UNSIGNED_BYTE, null);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_S, i.CLAMP_TO_EDGE);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_T, i.CLAMP_TO_EDGE);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MAG_FILTER, i.NEAREST);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MIN_FILTER, i.NEAREST);
        i.bindTexture(i.TEXTURE_2D, e);
        i.texImage2D(i.TEXTURE_2D, 0, i.RGBA, 16, 16, 0, i.RGBA, i.UNSIGNED_BYTE, null);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_S, i.CLAMP_TO_EDGE);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_WRAP_T, i.CLAMP_TO_EDGE);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MAG_FILTER, i.NEAREST);
        i.texParameteri(i.TEXTURE_2D, i.TEXTURE_MIN_FILTER, i.NEAREST);
        h = i.getParameter(i.MAX_VERTEX_TEXTURE_IMAGE_UNITS) > 0;
        var p;
        if (h) {
            p = {
                vertexShader: ["uniform lowp int renderType;", "uniform vec3 screenPosition;", "uniform vec2 scale;", "uniform float rotation;", "uniform sampler2D occlusionMap;", "attribute vec2 position;", "attribute vec2 uv;", "varying vec2 vUV;", "varying float vVisibility;", "void main() {", "vUV = uv;", "vec2 pos = position;", "if( renderType == 2 ) {", "vec4 visibility = texture2D( occlusionMap, vec2( 0.1, 0.1 ) );", "visibility += texture2D( occlusionMap, vec2( 0.5, 0.1 ) );", "visibility += texture2D( occlusionMap, vec2( 0.9, 0.1 ) );", "visibility += texture2D( occlusionMap, vec2( 0.9, 0.5 ) );", "visibility += texture2D( occlusionMap, vec2( 0.9, 0.9 ) );", "visibility += texture2D( occlusionMap, vec2( 0.5, 0.9 ) );", "visibility += texture2D( occlusionMap, vec2( 0.1, 0.9 ) );", "visibility += texture2D( occlusionMap, vec2( 0.1, 0.5 ) );", "visibility += texture2D( occlusionMap, vec2( 0.5, 0.5 ) );", "vVisibility =        visibility.r / 9.0;", "vVisibility *= 1.0 - visibility.g / 9.0;", "vVisibility *=       visibility.b / 9.0;", "vVisibility *= 1.0 - visibility.a / 9.0;", "pos.x = cos( rotation ) * position.x - sin( rotation ) * position.y;", "pos.y = sin( rotation ) * position.x + cos( rotation ) * position.y;", "}", "gl_Position = vec4( ( pos * scale + screenPosition.xy ).xy, screenPosition.z, 1.0 );", "}"].join("\n"),
                fragmentShader: ["uniform lowp int renderType;", "uniform sampler2D map;", "uniform float opacity;", "uniform vec3 color;", "varying vec2 vUV;", "varying float vVisibility;", "void main() {", "if( renderType == 0 ) {", "gl_FragColor = vec4( 1.0, 0.0, 1.0, 0.0 );", "} else if( renderType == 1 ) {", "gl_FragColor = texture2D( map, vUV );", "} else {", "vec4 texture = texture2D( map, vUV );", "texture.a *= opacity * vVisibility;", "gl_FragColor = texture;", "gl_FragColor.rgb *= color;", "}", "}"].join("\n")
            }
        } else {
            p = {
                vertexShader: ["uniform lowp int renderType;", "uniform vec3 screenPosition;", "uniform vec2 scale;", "uniform float rotation;", "attribute vec2 position;", "attribute vec2 uv;", "varying vec2 vUV;", "void main() {", "vUV = uv;", "vec2 pos = position;", "if( renderType == 2 ) {", "pos.x = cos( rotation ) * position.x - sin( rotation ) * position.y;", "pos.y = sin( rotation ) * position.x + cos( rotation ) * position.y;", "}", "gl_Position = vec4( ( pos * scale + screenPosition.xy ).xy, screenPosition.z, 1.0 );", "}"].join("\n"),
                fragmentShader: ["precision mediump float;", "uniform lowp int renderType;", "uniform sampler2D map;", "uniform sampler2D occlusionMap;", "uniform float opacity;", "uniform vec3 color;", "varying vec2 vUV;", "void main() {", "if( renderType == 0 ) {", "gl_FragColor = vec4( texture2D( map, vUV ).rgb, 0.0 );", "} else if( renderType == 1 ) {", "gl_FragColor = texture2D( map, vUV );", "} else {", "float visibility = texture2D( occlusionMap, vec2( 0.5, 0.1 ) ).a;", "visibility += texture2D( occlusionMap, vec2( 0.9, 0.5 ) ).a;", "visibility += texture2D( occlusionMap, vec2( 0.5, 0.9 ) ).a;", "visibility += texture2D( occlusionMap, vec2( 0.1, 0.5 ) ).a;", "visibility = ( 1.0 - visibility / 4.0 );", "vec4 texture = texture2D( map, vUV );", "texture.a *= opacity * visibility;", "gl_FragColor = texture;", "gl_FragColor.rgb *= color;", "}", "}"].join("\n")
            }
        }
        g = b(p);
        f = {
            vertex: i.getAttribLocation(g, "position"),
            uv: i.getAttribLocation(g, "uv")
        };
        l = {
            renderType: i.getUniformLocation(g, "renderType"),
            map: i.getUniformLocation(g, "map"),
            occlusionMap: i.getUniformLocation(g, "occlusionMap"),
            opacity: i.getUniformLocation(g, "opacity"),
            color: i.getUniformLocation(g, "color"),
            scale: i.getUniformLocation(g, "scale"),
            rotation: i.getUniformLocation(g, "rotation"),
            screenPosition: i.getUniformLocation(g, "screenPosition")
        }
    };
    this.render = function(H, D, A, n) {
        if (c.length === 0) {
            return
        }
        var F = new THREE.Vector3();
        var p = n / A,
            G = A * 0.5,
            v = n * 0.5;
        var s = 16 / n,
            I = new THREE.Vector2(s * p, s);
        var r = new THREE.Vector3(1, 1, 0),
            q = new THREE.Vector2(1, 1);
        if (g === undefined) {
            m()
        }
        i.useProgram(g);
        i.enableVertexAttribArray(f.vertex);
        i.enableVertexAttribArray(f.uv);
        i.uniform1i(l.occlusionMap, 0);
        i.uniform1i(l.map, 1);
        i.bindBuffer(i.ARRAY_BUFFER, k);
        i.vertexAttribPointer(f.vertex, 2, i.FLOAT, false, 2 * 8, 0);
        i.vertexAttribPointer(f.uv, 2, i.FLOAT, false, 2 * 8, 8);
        i.bindBuffer(i.ELEMENT_ARRAY_BUFFER, a);
        i.disable(i.CULL_FACE);
        i.depthMask(false);
        for (var C = 0, u = c.length; C < u; C++) {
            s = 16 / n;
            I.set(s * p, s);
            var o = c[C];
            F.set(o.matrixWorld.elements[12], o.matrixWorld.elements[13], o.matrixWorld.elements[14]);
            F.applyMatrix4(D.matrixWorldInverse);
            F.applyProjection(D.projectionMatrix);
            r.copy(F);
            q.x = r.x * G + G;
            q.y = r.y * v + v;
            if (h || (q.x > 0 && q.x < A && q.y > 0 && q.y < n)) {
                i.activeTexture(i.TEXTURE1);
                i.bindTexture(i.TEXTURE_2D, d);
                i.copyTexImage2D(i.TEXTURE_2D, 0, i.RGB, q.x - 8, q.y - 8, 16, 16, 0);
                i.uniform1i(l.renderType, 0);
                i.uniform2f(l.scale, I.x, I.y);
                i.uniform3f(l.screenPosition, r.x, r.y, r.z);
                i.disable(i.BLEND);
                i.enable(i.DEPTH_TEST);
                i.drawElements(i.TRIANGLES, 6, i.UNSIGNED_SHORT, 0);
                i.activeTexture(i.TEXTURE0);
                i.bindTexture(i.TEXTURE_2D, e);
                i.copyTexImage2D(i.TEXTURE_2D, 0, i.RGBA, q.x - 8, q.y - 8, 16, 16, 0);
                i.uniform1i(l.renderType, 1);
                i.disable(i.DEPTH_TEST);
                i.activeTexture(i.TEXTURE1);
                i.bindTexture(i.TEXTURE_2D, d);
                i.drawElements(i.TRIANGLES, 6, i.UNSIGNED_SHORT, 0);
                o.positionScreen.copy(r);
                if (o.customUpdateCallback) {
                    o.customUpdateCallback(o)
                } else {
                    o.updateLensFlares()
                }
                i.uniform1i(l.renderType, 2);
                i.enable(i.BLEND);
                for (var B = 0, E = o.lensFlares.length; B < E; B++) {
                    var t = o.lensFlares[B];
                    if (t.opacity > 0.001 && t.scale > 0.001) {
                        r.x = t.x;
                        r.y = t.y;
                        r.z = t.z;
                        s = t.size * t.scale / n;
                        I.x = s * p;
                        I.y = s;
                        i.uniform3f(l.screenPosition, r.x, r.y, r.z);
                        i.uniform2f(l.scale, I.x, I.y);
                        i.uniform1f(l.rotation, t.rotation);
                        i.uniform1f(l.opacity, t.opacity);
                        i.uniform3f(l.color, t.color.r, t.color.g, t.color.b);
                        j.setBlending(t.blending, t.blendEquation, t.blendSrc, t.blendDst);
                        j.setTexture(t.texture, 1);
                        i.drawElements(i.TRIANGLES, 6, i.UNSIGNED_SHORT, 0)
                    }
                }
            }
        }
        i.enable(i.CULL_FACE);
        i.enable(i.DEPTH_TEST);
        i.depthMask(true);
        j.resetGLState()
    };

    function b(p) {
        var o = i.createProgram();
        var n = i.createShader(i.FRAGMENT_SHADER);
        var r = i.createShader(i.VERTEX_SHADER);
        var q = "precision " + j.getPrecision() + " float;\n";
        i.shaderSource(n, q + p.fragmentShader);
        i.shaderSource(r, q + p.vertexShader);
        i.compileShader(n);
        i.compileShader(r);
        i.attachShader(o, n);
        i.attachShader(o, r);
        i.linkProgram(o);
        return o
    }
};
THREE.ShadowMapPlugin = function(q, e, r, h) {
    var f = q.context;
    var m, u, a, c, p = new THREE.Frustum(),
        b = new THREE.Matrix4(),
        o = new THREE.Vector3(),
        s = new THREE.Vector3(),
        g = new THREE.Vector3(),
        n = [];
    var j = THREE.ShaderLib.depthRGBA;
    var t = THREE.UniformsUtils.clone(j.uniforms);
    m = new THREE.ShaderMaterial({
        uniforms: t,
        vertexShader: j.vertexShader,
        fragmentShader: j.fragmentShader
    });
    u = new THREE.ShaderMaterial({
        uniforms: t,
        vertexShader: j.vertexShader,
        fragmentShader: j.fragmentShader,
        morphTargets: true
    });
    a = new THREE.ShaderMaterial({
        uniforms: t,
        vertexShader: j.vertexShader,
        fragmentShader: j.fragmentShader,
        skinning: true
    });
    c = new THREE.ShaderMaterial({
        uniforms: t,
        vertexShader: j.vertexShader,
        fragmentShader: j.fragmentShader,
        morphTargets: true,
        skinning: true
    });
    m._shadowPass = true;
    u._shadowPass = true;
    a._shadowPass = true;
    c._shadowPass = true;
    this.render = function(X, V) {
        if (q.shadowMapEnabled === false) {
            return
        }
        var U, J, T, W, O, E, Y, aa, I, S, L, B, ab, G, Z = [],
            R = 0,
            A = null;
        f.clearColor(1, 1, 1, 1);
        f.disable(f.BLEND);
        f.enable(f.CULL_FACE);
        f.frontFace(f.CCW);
        if (q.shadowMapCullFace === THREE.CullFaceFront) {
            f.cullFace(f.FRONT)
        } else {
            f.cullFace(f.BACK)
        }
        q.setDepthTest(true);
        for (U = 0, J = e.length; U < J; U++) {
            G = e[U];
            if (!G.castShadow) {
                continue
            }
            if ((G instanceof THREE.DirectionalLight) && G.shadowCascade) {
                for (O = 0; O < G.shadowCascadeCount; O++) {
                    var F;
                    if (!G.shadowCascadeArray[O]) {
                        F = l(G, O);
                        F.originalCamera = V;
                        var Q = new THREE.Gyroscope();
                        Q.position.copy(G.shadowCascadeOffset);
                        Q.add(F);
                        Q.add(F.target);
                        V.add(Q);
                        G.shadowCascadeArray[O] = F
                    } else {
                        F = G.shadowCascadeArray[O]
                    }
                    v(G, O);
                    Z[R] = F;
                    R++
                }
            } else {
                Z[R] = G;
                R++
            }
        }
        for (U = 0, J = Z.length; U < J; U++) {
            G = Z[U];
            if (!G.shadowMap) {
                var N = THREE.LinearFilter;
                if (q.shadowMapType === THREE.PCFSoftShadowMap) {
                    N = THREE.NearestFilter
                }
                var P = {
                    minFilter: N,
                    magFilter: N,
                    format: THREE.RGBAFormat
                };
                G.shadowMap = new THREE.WebGLRenderTarget(G.shadowMapWidth, G.shadowMapHeight, P);
                G.shadowMapSize = new THREE.Vector2(G.shadowMapWidth, G.shadowMapHeight);
                G.shadowMatrix = new THREE.Matrix4()
            }
            if (!G.shadowCamera) {
                if (G instanceof THREE.SpotLight) {
                    G.shadowCamera = new THREE.PerspectiveCamera(G.shadowCameraFov, G.shadowMapWidth / G.shadowMapHeight, G.shadowCameraNear, G.shadowCameraFar)
                } else {
                    if (G instanceof THREE.DirectionalLight) {
                        G.shadowCamera = new THREE.OrthographicCamera(G.shadowCameraLeft, G.shadowCameraRight, G.shadowCameraTop, G.shadowCameraBottom, G.shadowCameraNear, G.shadowCameraFar)
                    } else {
                        console.error("Unsupported light type for shadow");
                        continue
                    }
                }
                X.add(G.shadowCamera);
                if (X.autoUpdate === true) {
                    X.updateMatrixWorld()
                }
            }
            if (G.shadowCameraVisible && !G.cameraHelper) {
                G.cameraHelper = new THREE.CameraHelper(G.shadowCamera);
                X.add(G.cameraHelper)
            }
            if (G.isVirtual && F.originalCamera == V) {
                d(V, G)
            }
            E = G.shadowMap;
            Y = G.shadowMatrix;
            aa = G.shadowCamera;
            aa.position.setFromMatrixPosition(G.matrixWorld);
            g.setFromMatrixPosition(G.target.matrixWorld);
            aa.lookAt(g);
            aa.updateMatrixWorld();
            aa.matrixWorldInverse.getInverse(aa.matrixWorld);
            if (G.cameraHelper) {
                G.cameraHelper.visible = G.shadowCameraVisible
            }
            if (G.shadowCameraVisible) {
                G.cameraHelper.update()
            }
            Y.set(0.5, 0, 0, 0.5, 0, 0.5, 0, 0.5, 0, 0, 0.5, 0.5, 0, 0, 0, 1);
            Y.multiply(aa.projectionMatrix);
            Y.multiply(aa.matrixWorldInverse);
            b.multiplyMatrices(aa.projectionMatrix, aa.matrixWorldInverse);
            p.setFromMatrix(b);
            q.setRenderTarget(E);
            q.clear();
            n.length = 0;
            i(X, X, aa);
            var D, H, K;
            for (T = 0, W = n.length; T < W; T++) {
                B = n[T];
                ab = B.object;
                S = B.buffer;
                D = k(ab);
                H = ab.geometry.morphTargets !== undefined && ab.geometry.morphTargets.length > 0 && D.morphTargets;
                K = ab instanceof THREE.SkinnedMesh && D.skinning;
                if (ab.customDepthMaterial) {
                    L = ab.customDepthMaterial
                } else {
                    if (K) {
                        L = H ? c : a
                    } else {
                        if (H) {
                            L = u
                        } else {
                            L = m
                        }
                    }
                }
                q.setMaterialFaces(D);
                if (S instanceof THREE.BufferGeometry) {
                    q.renderBufferDirect(aa, e, A, L, S, ab)
                } else {
                    q.renderBuffer(aa, e, A, L, S, ab)
                }
            }
            for (T = 0, W = h.length; T < W; T++) {
                B = h[T];
                ab = B.object;
                if (ab.visible && ab.castShadow) {
                    ab._modelViewMatrix.multiplyMatrices(aa.matrixWorldInverse, ab.matrixWorld);
                    q.renderImmediateObject(aa, e, A, m, ab)
                }
            }
        }
        var C = q.getClearColor(),
            M = q.getClearAlpha();
        f.clearColor(C.r, C.g, C.b, M);
        f.enable(f.BLEND);
        if (q.shadowMapCullFace === THREE.CullFaceFront) {
            f.cullFace(f.BACK)
        }
        q.resetGLState()
    };

    function i(F, B, E) {
        if (B.visible) {
            var D = r[B.id];
            if (D && B.castShadow && (B.frustumCulled === false || p.intersectsObject(B) === true)) {
                for (var C = 0, A = D.length; C < A; C++) {
                    var G = D[C];
                    B._modelViewMatrix.multiplyMatrices(E.matrixWorldInverse, B.matrixWorld);
                    n.push(G)
                }
            }
            for (var C = 0, A = B.children.length; C < A; C++) {
                i(F, B.children[C], E)
            }
        }
    }

    function l(B, D) {
        var A = new THREE.DirectionalLight();
        A.isVirtual = true;
        A.onlyShadow = true;
        A.castShadow = true;
        A.shadowCameraNear = B.shadowCameraNear;
        A.shadowCameraFar = B.shadowCameraFar;
        A.shadowCameraLeft = B.shadowCameraLeft;
        A.shadowCameraRight = B.shadowCameraRight;
        A.shadowCameraBottom = B.shadowCameraBottom;
        A.shadowCameraTop = B.shadowCameraTop;
        A.shadowCameraVisible = B.shadowCameraVisible;
        A.shadowDarkness = B.shadowDarkness;
        A.shadowBias = B.shadowCascadeBias[D];
        A.shadowMapWidth = B.shadowCascadeWidth[D];
        A.shadowMapHeight = B.shadowCascadeHeight[D];
        A.pointsWorld = [];
        A.pointsFrustum = [];
        var G = A.pointsWorld,
            C = A.pointsFrustum;
        for (var F = 0; F < 8; F++) {
            G[F] = new THREE.Vector3();
            C[F] = new THREE.Vector3()
        }
        var H = B.shadowCascadeNearZ[D];
        var E = B.shadowCascadeFarZ[D];
        C[0].set(-1, -1, H);
        C[1].set(1, -1, H);
        C[2].set(-1, 1, H);
        C[3].set(1, 1, H);
        C[4].set(-1, -1, E);
        C[5].set(1, -1, E);
        C[6].set(-1, 1, E);
        C[7].set(1, 1, E);
        return A
    }

    function v(B, D) {
        var A = B.shadowCascadeArray[D];
        A.position.copy(B.position);
        A.target.position.copy(B.target.position);
        A.lookAt(A.target);
        A.shadowCameraVisible = B.shadowCameraVisible;
        A.shadowDarkness = B.shadowDarkness;
        A.shadowBias = B.shadowCascadeBias[D];
        var F = B.shadowCascadeNearZ[D];
        var E = B.shadowCascadeFarZ[D];
        var C = A.pointsFrustum;
        C[0].z = F;
        C[1].z = F;
        C[2].z = F;
        C[3].z = F;
        C[4].z = E;
        C[5].z = E;
        C[6].z = E;
        C[7].z = E
    }

    function d(D, A) {
        var F = A.shadowCamera,
            B = A.pointsFrustum,
            E = A.pointsWorld;
        o.set(Infinity, Infinity, Infinity);
        s.set(-Infinity, -Infinity, -Infinity);
        for (var C = 0; C < 8; C++) {
            var G = E[C];
            G.copy(B[C]);
            G.unproject(D);
            G.applyMatrix4(F.matrixWorldInverse);
            if (G.x < o.x) {
                o.x = G.x
            }
            if (G.x > s.x) {
                s.x = G.x
            }
            if (G.y < o.y) {
                o.y = G.y
            }
            if (G.y > s.y) {
                s.y = G.y
            }
            if (G.z < o.z) {
                o.z = G.z
            }
            if (G.z > s.z) {
                s.z = G.z
            }
        }
        F.left = o.x;
        F.right = s.x;
        F.top = s.y;
        F.bottom = o.y;
        F.updateProjectionMatrix()
    }

    function k(A) {
        return A.material instanceof THREE.MeshFaceMaterial ? A.material.materials[0] : A.material
    }
};
THREE.SpritePlugin = function(k, j) {
    var g = k.context;
    var l, a;
    var e, d, n;
    var i;
    var h = new THREE.Vector3();
    var c = new THREE.Quaternion();
    var f = new THREE.Vector3();
    var o = function() {
        var r = new Float32Array([-0.5, -0.5, 0, 0, 0.5, -0.5, 1, 0, 0.5, 0.5, 1, 1, -0.5, 0.5, 0, 1]);
        var p = new Uint16Array([0, 1, 2, 0, 2, 3]);
        l = g.createBuffer();
        a = g.createBuffer();
        g.bindBuffer(g.ARRAY_BUFFER, l);
        g.bufferData(g.ARRAY_BUFFER, r, g.STATIC_DRAW);
        g.bindBuffer(g.ELEMENT_ARRAY_BUFFER, a);
        g.bufferData(g.ELEMENT_ARRAY_BUFFER, p, g.STATIC_DRAW);
        e = b();
        d = {
            position: g.getAttribLocation(e, "position"),
            uv: g.getAttribLocation(e, "uv")
        };
        n = {
            uvOffset: g.getUniformLocation(e, "uvOffset"),
            uvScale: g.getUniformLocation(e, "uvScale"),
            rotation: g.getUniformLocation(e, "rotation"),
            scale: g.getUniformLocation(e, "scale"),
            color: g.getUniformLocation(e, "color"),
            map: g.getUniformLocation(e, "map"),
            opacity: g.getUniformLocation(e, "opacity"),
            modelViewMatrix: g.getUniformLocation(e, "modelViewMatrix"),
            projectionMatrix: g.getUniformLocation(e, "projectionMatrix"),
            fogType: g.getUniformLocation(e, "fogType"),
            fogDensity: g.getUniformLocation(e, "fogDensity"),
            fogNear: g.getUniformLocation(e, "fogNear"),
            fogFar: g.getUniformLocation(e, "fogFar"),
            fogColor: g.getUniformLocation(e, "fogColor"),
            alphaTest: g.getUniformLocation(e, "alphaTest")
        };
        var q = document.createElement("canvas");
        q.width = 8;
        q.height = 8;
        var s = q.getContext("2d");
        s.fillStyle = "white";
        s.fillRect(0, 0, 8, 8);
        i = new THREE.Texture(q);
        i.needsUpdate = true
    };
    this.render = function(u, B) {
        if (j.length === 0) {
            return
        }
        if (e === undefined) {
            o()
        }
        g.useProgram(e);
        g.enableVertexAttribArray(d.position);
        g.enableVertexAttribArray(d.uv);
        g.disable(g.CULL_FACE);
        g.enable(g.BLEND);
        g.bindBuffer(g.ARRAY_BUFFER, l);
        g.vertexAttribPointer(d.position, 2, g.FLOAT, false, 2 * 8, 0);
        g.vertexAttribPointer(d.uv, 2, g.FLOAT, false, 2 * 8, 8);
        g.bindBuffer(g.ELEMENT_ARRAY_BUFFER, a);
        g.uniformMatrix4fv(n.projectionMatrix, false, B.projectionMatrix.elements);
        g.activeTexture(g.TEXTURE0);
        g.uniform1i(n.map, 0);
        var v = 0;
        var D = 0;
        var p = u.fog;
        if (p) {
            g.uniform3f(n.fogColor, p.color.r, p.color.g, p.color.b);
            if (p instanceof THREE.Fog) {
                g.uniform1f(n.fogNear, p.near);
                g.uniform1f(n.fogFar, p.far);
                g.uniform1i(n.fogType, 1);
                v = 1;
                D = 1
            } else {
                if (p instanceof THREE.FogExp2) {
                    g.uniform1f(n.fogDensity, p.density);
                    g.uniform1i(n.fogType, 2);
                    v = 2;
                    D = 2
                }
            }
        } else {
            g.uniform1i(n.fogType, 0);
            v = 0;
            D = 0
        }
        for (var t = 0, r = j.length; t < r; t++) {
            var C = j[t];
            C._modelViewMatrix.multiplyMatrices(B.matrixWorldInverse, C.matrixWorld);
            C.z = -C._modelViewMatrix.elements[14]
        }
        j.sort(m);
        var q = [];
        for (var t = 0, r = j.length; t < r; t++) {
            var C = j[t];
            var A = C.material;
            g.uniform1f(n.alphaTest, A.alphaTest);
            g.uniformMatrix4fv(n.modelViewMatrix, false, C._modelViewMatrix.elements);
            C.matrixWorld.decompose(h, c, f);
            q[0] = f.x;
            q[1] = f.y;
            var s = 0;
            if (u.fog && A.fog) {
                s = D
            }
            if (v !== s) {
                g.uniform1i(n.fogType, s);
                v = s
            }
            if (A.map !== null) {
                g.uniform2f(n.uvOffset, A.map.offset.x, A.map.offset.y);
                g.uniform2f(n.uvScale, A.map.repeat.x, A.map.repeat.y)
            } else {
                g.uniform2f(n.uvOffset, 0, 0);
                g.uniform2f(n.uvScale, 1, 1)
            }
            g.uniform1f(n.opacity, A.opacity);
            g.uniform3f(n.color, A.color.r, A.color.g, A.color.b);
            g.uniform1f(n.rotation, A.rotation);
            g.uniform2fv(n.scale, q);
            k.setBlending(A.blending, A.blendEquation, A.blendSrc, A.blendDst);
            k.setDepthTest(A.depthTest);
            k.setDepthWrite(A.depthWrite);
            if (A.map && A.map.image && A.map.image.width) {
                k.setTexture(A.map, 0)
            } else {
                k.setTexture(i, 0)
            }
            g.drawElements(g.TRIANGLES, 6, g.UNSIGNED_SHORT, 0)
        }
        g.enable(g.CULL_FACE);
        k.resetGLState()
    };

    function b() {
        var q = g.createProgram();
        var r = g.createShader(g.VERTEX_SHADER);
        var p = g.createShader(g.FRAGMENT_SHADER);
        g.shaderSource(r, ["precision " + k.getPrecision() + " float;", "uniform mat4 modelViewMatrix;", "uniform mat4 projectionMatrix;", "uniform float rotation;", "uniform vec2 scale;", "uniform vec2 uvOffset;", "uniform vec2 uvScale;", "attribute vec2 position;", "attribute vec2 uv;", "varying vec2 vUV;", "void main() {", "vUV = uvOffset + uv * uvScale;", "vec2 alignedPosition = position * scale;", "vec2 rotatedPosition;", "rotatedPosition.x = cos( rotation ) * alignedPosition.x - sin( rotation ) * alignedPosition.y;", "rotatedPosition.y = sin( rotation ) * alignedPosition.x + cos( rotation ) * alignedPosition.y;", "vec4 finalPosition;", "finalPosition = modelViewMatrix * vec4( 0.0, 0.0, 0.0, 1.0 );", "finalPosition.xy += rotatedPosition;", "finalPosition = projectionMatrix * finalPosition;", "gl_Position = finalPosition;", "}"].join("\n"));
        g.shaderSource(p, ["precision " + k.getPrecision() + " float;", "uniform vec3 color;", "uniform sampler2D map;", "uniform float opacity;", "uniform int fogType;", "uniform vec3 fogColor;", "uniform float fogDensity;", "uniform float fogNear;", "uniform float fogFar;", "uniform float alphaTest;", "varying vec2 vUV;", "void main() {", "vec4 texture = texture2D( map, vUV );", "if ( texture.a < alphaTest ) discard;", "gl_FragColor = vec4( color * texture.xyz, texture.a * opacity );", "if ( fogType > 0 ) {", "float depth = gl_FragCoord.z / gl_FragCoord.w;", "float fogFactor = 0.0;", "if ( fogType == 1 ) {", "fogFactor = smoothstep( fogNear, fogFar, depth );", "} else {", "const float LOG2 = 1.442695;", "float fogFactor = exp2( - fogDensity * fogDensity * depth * depth * LOG2 );", "fogFactor = 1.0 - clamp( fogFactor, 0.0, 1.0 );", "}", "gl_FragColor = mix( gl_FragColor, vec4( fogColor, gl_FragColor.w ), fogFactor );", "}", "}"].join("\n"));
        g.compileShader(r);
        g.compileShader(p);
        g.attachShader(q, r);
        g.attachShader(q, p);
        g.linkProgram(q);
        return q
    }

    function m(q, p) {
        if (q.z !== p.z) {
            return p.z - q.z
        } else {
            return p.id - q.id
        }
    }
};
THREE.GeometryUtils = {
    merge: function(c, b, d) {
        console.warn("THREE.GeometryUtils: .merge() has been moved to Geometry. Use geometry.merge( geometry2, matrix, materialIndexOffset ) instead.");
        var a;
        if (b instanceof THREE.Mesh) {
            b.matrixAutoUpdate && b.updateMatrix();
            a = b.matrix;
            b = b.geometry
        }
        c.merge(b, a, d)
    },
    center: function(a) {
        console.warn("THREE.GeometryUtils: .center() has been moved to Geometry. Use geometry.center() instead.");
        return a.center()
    }
};
THREE.ImageUtils = {
    crossOrigin: undefined,
    loadTexture: function(c, b, d, f) {
        var a = new THREE.ImageLoader();
        a.crossOrigin = this.crossOrigin;
        var e = new THREE.Texture(undefined, b);
        a.load(c, function(g) {
            e.image = g;
            e.needsUpdate = true;
            if (d) {
                d(e)
            }
        }, undefined, function(g) {
            if (f) {
                f(g)
            }
        });
        e.sourceFile = c;
        return e
    },
    loadTextureCube: function(e, a, h, d) {
        var j = [];
        var l = new THREE.ImageLoader();
        l.crossOrigin = this.crossOrigin;
        var f = new THREE.CubeTexture(j, a);
        f.flipY = false;
        var c = 0;
        var g = function(m) {
            l.load(e[m], function(i) {
                f.images[m] = i;
                c += 1;
                if (c === 6) {
                    f.needsUpdate = true;
                    if (h) {
                        h(f)
                    }
                }
            }, undefined, d)
        };
        for (var b = 0, k = e.length; b < k; ++b) {
            g(b)
        }
        return f
    },
    loadCompressedTexture: function() {
        console.error("THREE.ImageUtils.loadCompressedTexture has been removed. Use THREE.DDSLoader instead.")
    },
    loadCompressedTextureCube: function() {
        console.error("THREE.ImageUtils.loadCompressedTextureCube has been removed. Use THREE.DDSLoader instead.")
    },
    getNormalMap: function(q, E) {
        var d = function(G, i) {
            return [G[1] * i[2] - G[2] * i[1], G[2] * i[0] - G[0] * i[2], G[0] * i[1] - G[1] * i[0]]
        };
        var v = function(G, i) {
            return [G[0] - i[0], G[1] - i[1], G[2] - i[2]]
        };
        var s = function(G) {
            var i = Math.sqrt(G[0] * G[0] + G[1] * G[1] + G[2] * G[2]);
            return [G[0] / i, G[1] / i, G[2] / i]
        };
        E = E | 1;
        var r = q.width;
        var p = q.height;
        var e = document.createElement("canvas");
        e.width = r;
        e.height = p;
        var c = e.getContext("2d");
        c.drawImage(q, 0, 0);
        var F = c.getImageData(0, 0, r, p).data;
        var A = c.createImageData(r, p);
        var k = A.data;
        for (var m = 0; m < r; m++) {
            for (var l = 0; l < p; l++) {
                var f = l - 1 < 0 ? 0 : l - 1;
                var h = l + 1 > p - 1 ? p - 1 : l + 1;
                var g = m - 1 < 0 ? 0 : m - 1;
                var j = m + 1 > r - 1 ? r - 1 : m + 1;
                var u = [];
                var D = [0, 0, F[(l * r + m) * 4] / 255 * E];
                u.push([-1, 0, F[(l * r + g) * 4] / 255 * E]);
                u.push([-1, -1, F[(f * r + g) * 4] / 255 * E]);
                u.push([0, -1, F[(f * r + m) * 4] / 255 * E]);
                u.push([1, -1, F[(f * r + j) * 4] / 255 * E]);
                u.push([1, 0, F[(l * r + j) * 4] / 255 * E]);
                u.push([1, 1, F[(h * r + j) * 4] / 255 * E]);
                u.push([0, 1, F[(h * r + m) * 4] / 255 * E]);
                u.push([-1, 1, F[(h * r + g) * 4] / 255 * E]);
                var o = [];
                var B = u.length;
                for (var t = 0; t < B; t++) {
                    var b = u[t];
                    var a = u[(t + 1) % B];
                    b = v(b, D);
                    a = v(a, D);
                    o.push(s(d(b, a)))
                }
                var C = [0, 0, 0];
                for (var t = 0; t < o.length; t++) {
                    C[0] += o[t][0];
                    C[1] += o[t][1];
                    C[2] += o[t][2]
                }
                C[0] /= o.length;
                C[1] /= o.length;
                C[2] /= o.length;
                var n = (l * r + m) * 4;
                k[n] = ((C[0] + 1) / 2 * 255) | 0;
                k[n + 1] = ((C[1] + 1) / 2 * 255) | 0;
                k[n + 2] = (C[2] * 255) | 0;
                k[n + 3] = 255
            }
        }
        c.putImageData(A, 0, 0);
        return e
    },
    generateDataTexture: function(c, l, d) {
        var m = c * l;
        var f = new Uint8Array(3 * m);
        var a = Math.floor(d.r * 255);
        var h = Math.floor(d.g * 255);
        var k = Math.floor(d.b * 255);
        for (var e = 0; e < m; e++) {
            f[e * 3] = a;
            f[e * 3 + 1] = h;
            f[e * 3 + 2] = k
        }
        var j = new THREE.DataTexture(f, c, l, THREE.RGBFormat);
        j.needsUpdate = true;
        return j
    }
};
THREE.SceneUtils = {
    createMultiMaterialObject: function(e, b) {
        var d = new THREE.Object3D();
        for (var c = 0, a = b.length; c < a; c++) {
            d.add(new THREE.Mesh(e, b[c]))
        }
        return d
    },
    detach: function(c, a, b) {
        c.applyMatrix(a.matrixWorld);
        a.remove(c);
        b.add(c)
    },
    attach: function(d, c, a) {
        var b = new THREE.Matrix4();
        b.getInverse(a.matrixWorld);
        d.applyMatrix(b);
        c.remove(d);
        a.add(d)
    }
};
THREE.FontUtils = {
    faces: {},
    face: "helvetiker",
    weight: "normal",
    style: "normal",
    size: 150,
    divisions: 10,
    getFace: function() {
        try {
            return this.faces[this.face][this.weight][this.style]
        } catch (a) {
            throw "The font " + this.face + " with " + this.weight + " weight and " + this.style + " style is missing."
        }
    },
    loadFace: function(d) {
        var a = d.familyName.toLowerCase();
        var b = this;
        b.faces[a] = b.faces[a] || {};
        b.faces[a][d.cssFontWeight] = b.faces[a][d.cssFontWeight] || {};
        b.faces[a][d.cssFontWeight][d.cssFontStyle] = d;
        var c = b.faces[a][d.cssFontWeight][d.cssFontStyle] = d;
        return d
    },
    drawText: function(n) {
        var a = [],
            e = [];
        var j, c, l = this.getFace(),
            g = this.size / l.resolution,
            h = 0,
            m = String(n).split(""),
            d = m.length;
        var f = [];
        for (j = 0; j < d; j++) {
            var o = new THREE.Path();
            var k = this.extractGlyphPoints(m[j], l, g, h, o);
            h += k.offset;
            f.push(k.path)
        }
        var b = h / 2;
        return {
            paths: f,
            offset: b
        }
    },
    extractGlyphPoints: function(E, j, I, f, r) {
        var J = [];
        var v, s, d, e, u, b, G, D, l, k, h, g, q, C, o, B, n, A, a, m = j.glyphs[E] || j.glyphs["?"];
        if (!m) {
            return
        }
        if (m.o) {
            e = m._cachedOutline || (m._cachedOutline = m.o.split(" "));
            b = e.length;
            G = I;
            D = I;
            for (v = 0; v < b;) {
                u = e[v++];
                switch (u) {
                    case "m":
                        l = e[v++] * G + f;
                        k = e[v++] * D;
                        r.moveTo(l, k);
                        break;
                    case "l":
                        l = e[v++] * G + f;
                        k = e[v++] * D;
                        r.lineTo(l, k);
                        break;
                    case "q":
                        h = e[v++] * G + f;
                        g = e[v++] * D;
                        o = e[v++] * G + f;
                        B = e[v++] * D;
                        r.quadraticCurveTo(o, B, h, g);
                        a = J[J.length - 1];
                        if (a) {
                            q = a.x;
                            C = a.y;
                            for (s = 1, d = this.divisions; s <= d; s++) {
                                var p = s / d;
                                var H = THREE.Shape.Utils.b2(p, q, o, h);
                                var F = THREE.Shape.Utils.b2(p, C, B, g)
                            }
                        }
                        break;
                    case "b":
                        h = e[v++] * G + f;
                        g = e[v++] * D;
                        o = e[v++] * G + f;
                        B = e[v++] * D;
                        n = e[v++] * G + f;
                        A = e[v++] * D;
                        r.bezierCurveTo(o, B, n, A, h, g);
                        a = J[J.length - 1];
                        if (a) {
                            q = a.x;
                            C = a.y;
                            for (s = 1, d = this.divisions; s <= d; s++) {
                                var p = s / d;
                                var H = THREE.Shape.Utils.b3(p, q, o, n, h);
                                var F = THREE.Shape.Utils.b3(p, C, B, A, g)
                            }
                        }
                        break
                }
            }
        }
        return {
            offset: m.ha * I,
            path: r
        }
    }
};
THREE.FontUtils.generateShapes = function(i, j) {
    j = j || {};
    var l = j.size !== undefined ? j.size : 100;
    var h = j.curveSegments !== undefined ? j.curveSegments : 4;
    var d = j.font !== undefined ? j.font : "helvetiker";
    var g = j.weight !== undefined ? j.weight : "normal";
    var a = j.style !== undefined ? j.style : "normal";
    THREE.FontUtils.size = l;
    THREE.FontUtils.divisions = h;
    THREE.FontUtils.face = d;
    THREE.FontUtils.weight = g;
    THREE.FontUtils.style = a;
    var f = THREE.FontUtils.drawText(i);
    var k = f.paths;
    var c = [];
    for (var b = 0, e = k.length; b < e; b++) {
        Array.prototype.push.apply(c, k[b].toShapes())
    }
    return c
};
(function(c) {
    var b = 1e-10;
    var e = function(g, r) {
        var f = g.length;
        if (f < 3) {
            return null
        }
        var D = [],
            p = [],
            j = [];
        var A, q, o;
        if (d(g) > 0) {
            for (q = 0; q < f; q++) {
                p[q] = q
            }
        } else {
            for (q = 0; q < f; q++) {
                p[q] = (f - 1) - q
            }
        }
        var i = f;
        var h = 2 * i;
        for (q = i - 1; i > 2;) {
            if ((h--) <= 0) {
                if (r) {
                    return j
                }
                return D
            }
            A = q;
            if (i <= A) {
                A = 0
            }
            q = A + 1;
            if (i <= q) {
                q = 0
            }
            o = q + 1;
            if (i <= o) {
                o = 0
            }
            if (a(g, A, q, o, i, p)) {
                var m, l, k, C, B;
                m = p[A];
                l = p[q];
                k = p[o];
                D.push([g[m], g[l], g[k]]);
                j.push([p[A], p[q], p[o]]);
                for (C = q, B = q + 1; B < i; C++, B++) {
                    p[C] = p[B]
                }
                i--;
                h = 2 * i
            }
        }
        if (r) {
            return j
        }
        return D
    };
    var d = function(g) {
        var j = g.length;
        var f = 0;
        for (var i = j - 1, h = 0; h < j; i = h++) {
            f += g[i].x * g[h].y - g[h].x * g[i].y
        }
        return f * 0.5
    };
    var a = function(J, D, C, t, I, Q) {
        var H;
        var A, r, O, M;
        var i, g, G, F;
        A = J[Q[D]].x;
        r = J[Q[D]].y;
        O = J[Q[C]].x;
        M = J[Q[C]].y;
        i = J[Q[t]].x;
        g = J[Q[t]].y;
        if (b > (((O - A) * (g - r)) - ((M - r) * (i - A)))) {
            return false
        }
        var h, f, B, s, P, N;
        var l, k, L, K, o, m;
        var j, q, E;
        h = i - O;
        f = g - M;
        B = A - i;
        s = r - g;
        P = O - A;
        N = M - r;
        for (H = 0; H < I; H++) {
            G = J[Q[H]].x;
            F = J[Q[H]].y;
            if (((G === A) && (F === r)) || ((G === O) && (F === M)) || ((G === i) && (F === g))) {
                continue
            }
            l = G - A;
            k = F - r;
            L = G - O;
            K = F - M;
            o = G - i;
            m = F - g;
            E = h * K - f * L;
            j = P * k - N * l;
            q = B * m - s * o;
            if ((E >= -b) && (q >= -b) && (j >= -b)) {
                return false
            }
        }
        return true
    };
    c.Triangulate = e;
    c.Triangulate.area = d;
    return c
})(THREE.FontUtils);
self._typeface_js = {
    faces: THREE.FontUtils.faces,
    loadFace: THREE.FontUtils.loadFace
};
THREE.typeface_js = self._typeface_js;
THREE.Audio = function(a) {
    THREE.Object3D.call(this);
    this.type = "Audio";
    this.context = a.context;
    this.source = this.context.createBufferSource();
    this.gain = this.context.createGain();
    this.gain.connect(this.context.destination);
    this.panner = this.context.createPanner();
    this.panner.connect(this.gain)
};
THREE.Audio.prototype = Object.create(THREE.Object3D.prototype);
THREE.Audio.prototype.constructor = THREE.Audio;
THREE.Audio.prototype.load = function(a) {
    var b = this;
    var c = new XMLHttpRequest();
    c.open("GET", a, true);
    c.responseType = "arraybuffer";
    c.onload = function(d) {
        b.context.decodeAudioData(this.response, function(e) {
            b.source.buffer = e;
            b.source.connect(b.panner);
            b.source.start(0)
        })
    };
    c.send();
    return this
};
THREE.Audio.prototype.setLoop = function(a) {
    this.source.loop = a
};
THREE.Audio.prototype.setRefDistance = function(a) {
    this.panner.refDistance = a
};
THREE.Audio.prototype.setRolloffFactor = function(a) {
    this.panner.rolloffFactor = a
};
THREE.Audio.prototype.updateMatrixWorld = (function() {
    var a = new THREE.Vector3();
    return function(b) {
        THREE.Object3D.prototype.updateMatrixWorld.call(this, b);
        a.setFromMatrixPosition(this.matrixWorld);
        this.panner.setPosition(a.x, a.y, a.z)
    }
})();
THREE.AudioListener = function() {
    THREE.Object3D.call(this);
    this.type = "AudioListener";
    this.context = new(window.AudioContext || window.webkitAudioContext)()
};
THREE.AudioListener.prototype = Object.create(THREE.Object3D.prototype);
THREE.AudioListener.prototype.constructor = THREE.AudioListener;
THREE.AudioListener.prototype.updateMatrixWorld = (function() {
    var b = new THREE.Vector3();
    var e = new THREE.Quaternion();
    var f = new THREE.Vector3();
    var c = new THREE.Vector3();
    var d = new THREE.Vector3();
    var a = new THREE.Vector3();
    return function(i) {
        THREE.Object3D.prototype.updateMatrixWorld.call(this, i);
        var h = this.context.listener;
        var g = this.up;
        this.matrixWorld.decompose(b, e, f);
        c.set(0, 0, -1).applyQuaternion(e);
        d.subVectors(b, a);
        h.setPosition(b.x, b.y, b.z);
        h.setOrientation(c.x, c.y, c.z, g.x, g.y, g.z);
        h.setVelocity(d.x, d.y, d.z);
        a.copy(b)
    }
})();
THREE.Curve = function() {};
THREE.Curve.prototype.getPoint = function(a) {
    return null
};
THREE.Curve.prototype.getPointAt = function(a) {
    var b = this.getUtoTmapping(a);
    return this.getPoint(b)
};
THREE.Curve.prototype.getPoints = function(a) {
    if (!a) {
        a = 5
    }
    var c, b = [];
    for (c = 0; c <= a; c++) {
        b.push(this.getPoint(c / a))
    }
    return b
};
THREE.Curve.prototype.getSpacedPoints = function(a) {
    if (!a) {
        a = 5
    }
    var c, b = [];
    for (c = 0; c <= a; c++) {
        b.push(this.getPointAt(c / a))
    }
    return b
};
THREE.Curve.prototype.getLength = function() {
    var a = this.getLengths();
    return a[a.length - 1]
};
THREE.Curve.prototype.getLengths = function(b) {
    if (!b) {
        b = (this.__arcLengthDivisions) ? (this.__arcLengthDivisions) : 200
    }
    if (this.cacheArcLengths && (this.cacheArcLengths.length == b + 1) && !this.needsUpdate) {
        return this.cacheArcLengths
    }
    this.needsUpdate = false;
    var a = [];
    var f, d = this.getPoint(0);
    var e, c = 0;
    a.push(0);
    for (e = 1; e <= b; e++) {
        f = this.getPoint(e / b);
        c += f.distanceTo(d);
        a.push(c);
        d = f
    }
    this.cacheArcLengths = a;
    return a
};
THREE.Curve.prototype.updateArcLengths = function() {
    this.needsUpdate = true;
    this.getLengths()
};
THREE.Curve.prototype.getUtoTmapping = function(m, a) {
    var b = this.getLengths();
    var e = 0,
        j = b.length;
    var k;
    if (a) {
        k = a
    } else {
        k = m * b[j - 1]
    }
    var h = 0,
        d = j - 1,
        l;
    while (h <= d) {
        e = Math.floor(h + (d - h) / 2);
        l = b[e] - k;
        if (l < 0) {
            h = e + 1;
            continue
        } else {
            if (l > 0) {
                d = e - 1;
                continue
            } else {
                d = e;
                break
            }
        }
    }
    e = d;
    if (b[e] == k) {
        var o = e / (j - 1);
        return o
    }
    var f = b[e];
    var n = b[e + 1];
    var c = n - f;
    var g = (k - f) / c;
    var o = (e + g) / (j - 1);
    return o
};
THREE.Curve.prototype.getTangent = function(b) {
    var g = 0.0001;
    var d = b - g;
    var c = b + g;
    if (d < 0) {
        d = 0
    }
    if (c > 1) {
        c = 1
    }
    var f = this.getPoint(d);
    var e = this.getPoint(c);
    var a = e.clone().sub(f);
    return a.normalize()
};
THREE.Curve.prototype.getTangentAt = function(a) {
    var b = this.getUtoTmapping(a);
    return this.getTangent(b)
};
THREE.Curve.Utils = {
    tangentQuadraticBezier: function(a, d, c, b) {
        return 2 * (1 - a) * (c - d) + 2 * a * (b - c)
    },
    tangentCubicBezier: function(a, e, d, c, b) {
        return -3 * e * (1 - a) * (1 - a) + 3 * d * (1 - a) * (1 - a) - 6 * a * d * (1 - a) + 6 * a * c * (1 - a) - 3 * a * a * c + 3 * a * a * b
    },
    tangentSpline: function(i, h, g, f, d) {
        var e = 6 * i * i - 6 * i;
        var b = 3 * i * i - 4 * i + 1;
        var c = -6 * i * i + 6 * i;
        var a = 3 * i * i - 2 * i;
        return e + b + c + a
    },
    interpolate: function(h, g, e, d, i) {
        var f = (e - h) * 0.5;
        var c = (d - g) * 0.5;
        var b = i * i;
        var a = i * b;
        return (2 * g - 2 * e + f + c) * a + (-3 * g + 3 * e - 2 * f - c) * b + f * i + g
    }
};
THREE.Curve.create = function(a, b) {
    a.prototype = Object.create(THREE.Curve.prototype);
    a.prototype.constructor = a;
    a.prototype.getPoint = b;
    return a
};
THREE.CurvePath = function() {
    this.curves = [];
    this.bends = [];
    this.autoClose = false
};
THREE.CurvePath.prototype = Object.create(THREE.Curve.prototype);
THREE.CurvePath.prototype.constructor = THREE.CurvePath;
THREE.CurvePath.prototype.add = function(a) {
    this.curves.push(a)
};
THREE.CurvePath.prototype.checkConnection = function() {};
THREE.CurvePath.prototype.closePath = function() {
    var b = this.curves[0].getPoint(0);
    var a = this.curves[this.curves.length - 1].getPoint(1);
    if (!b.equals(a)) {
        this.curves.push(new THREE.LineCurve(a, b))
    }
};
THREE.CurvePath.prototype.getPoint = function(c) {
    var h = c * this.getLength();
    var g = this.getCurveLengths();
    var b = 0,
        e, f;
    while (b < g.length) {
        if (g[b] >= h) {
            e = g[b] - h;
            f = this.curves[b];
            var a = 1 - e / f.getLength();
            return f.getPointAt(a);
            break
        }
        b++
    }
    return null
};
THREE.CurvePath.prototype.getLength = function() {
    var a = this.getCurveLengths();
    return a[a.length - 1]
};
THREE.CurvePath.prototype.getCurveLengths = function() {
    if (this.cacheLengths && this.cacheLengths.length == this.curves.length) {
        return this.cacheLengths
    }
    var d = [],
        c = 0;
    var b, a = this.curves.length;
    for (b = 0; b < a; b++) {
        c += this.curves[b].getLength();
        d.push(c)
    }
    this.cacheLengths = d;
    return d
};
THREE.CurvePath.prototype.getBoundingBox = function() {
    var m = this.getPoints();
    var b, a, n;
    var f, e, d;
    b = a = Number.NEGATIVE_INFINITY;
    f = e = Number.POSITIVE_INFINITY;
    var c, g, l, h;
    var k = m[0] instanceof THREE.Vector3;
    h = k ? new THREE.Vector3() : new THREE.Vector2();
    for (g = 0, l = m.length; g < l; g++) {
        c = m[g];
        if (c.x > b) {
            b = c.x
        } else {
            if (c.x < f) {
                f = c.x
            }
        }
        if (c.y > a) {
            a = c.y
        } else {
            if (c.y < e) {
                e = c.y
            }
        }
        if (k) {
            if (c.z > n) {
                n = c.z
            } else {
                if (c.z < d) {
                    d = c.z
                }
            }
        }
        h.add(c)
    }
    var j = {
        minX: f,
        minY: e,
        maxX: b,
        maxY: a
    };
    if (k) {
        j.maxZ = n;
        j.minZ = d
    }
    return j
};
THREE.CurvePath.prototype.createPointsGeometry = function(a) {
    var b = this.getPoints(a, true);
    return this.createGeometry(b)
};
THREE.CurvePath.prototype.createSpacedPointsGeometry = function(a) {
    var b = this.getSpacedPoints(a, true);
    return this.createGeometry(b)
};
THREE.CurvePath.prototype.createGeometry = function(b) {
    var c = new THREE.Geometry();
    for (var a = 0; a < b.length; a++) {
        c.vertices.push(new THREE.Vector3(b[a].x, b[a].y, b[a].z || 0))
    }
    return c
};
THREE.CurvePath.prototype.addWrapPath = function(a) {
    this.bends.push(a)
};
THREE.CurvePath.prototype.getTransformedPoints = function(c, e) {
    var b = this.getPoints(c);
    var d, a;
    if (!e) {
        e = this.bends
    }
    for (d = 0, a = e.length; d < a; d++) {
        b = this.getWrapPoints(b, e[d])
    }
    return b
};
THREE.CurvePath.prototype.getTransformedSpacedPoints = function(c, e) {
    var b = this.getSpacedPoints(c);
    var d, a;
    if (!e) {
        e = this.bends
    }
    for (d = 0, a = e.length; d < a; d++) {
        b = this.getWrapPoints(b, e[d])
    }
    return b
};
THREE.CurvePath.prototype.getWrapPoints = function(f, l) {
    var a = this.getBoundingBox();
    var d, g, b, j, h, k;
    for (d = 0, g = f.length; d < g; d++) {
        b = f[d];
        j = b.x;
        h = b.y;
        k = j / a.maxX;
        k = l.getUtoTmapping(k, j);
        var c = l.getPoint(k);
        var e = l.getTangent(k);
        e.set(-e.y, e.x).multiplyScalar(h);
        b.x = c.x + e.x;
        b.y = c.y + e.y
    }
    return f
};
THREE.Gyroscope = function() {
    THREE.Object3D.call(this)
};
THREE.Gyroscope.prototype = Object.create(THREE.Object3D.prototype);
THREE.Gyroscope.prototype.constructor = THREE.Gyroscope;
THREE.Gyroscope.prototype.updateMatrixWorld = (function() {
    var d = new THREE.Vector3();
    var f = new THREE.Quaternion();
    var c = new THREE.Vector3();
    var b = new THREE.Vector3();
    var a = new THREE.Quaternion();
    var e = new THREE.Vector3();
    return function(j) {
        this.matrixAutoUpdate && this.updateMatrix();
        if (this.matrixWorldNeedsUpdate || j) {
            if (this.parent) {
                this.matrixWorld.multiplyMatrices(this.parent.matrixWorld, this.matrix);
                this.matrixWorld.decompose(b, a, e);
                this.matrix.decompose(d, f, c);
                this.matrixWorld.compose(b, f, e)
            } else {
                this.matrixWorld.copy(this.matrix)
            }
            this.matrixWorldNeedsUpdate = false;
            j = true
        }
        for (var h = 0, g = this.children.length; h < g; h++) {
            this.children[h].updateMatrixWorld(j)
        }
    }
}());
THREE.Path = function(a) {
    THREE.CurvePath.call(this);
    this.actions = [];
    if (a) {
        this.fromPoints(a)
    }
};
THREE.Path.prototype = Object.create(THREE.CurvePath.prototype);
THREE.Path.prototype.constructor = THREE.Path;
THREE.PathActions = {
    MOVE_TO: "moveTo",
    LINE_TO: "lineTo",
    QUADRATIC_CURVE_TO: "quadraticCurveTo",
    BEZIER_CURVE_TO: "bezierCurveTo",
    CSPLINE_THRU: "splineThru",
    ARC: "arc",
    ELLIPSE: "ellipse"
};
THREE.Path.prototype.fromPoints = function(b) {
    this.moveTo(b[0].x, b[0].y);
    for (var a = 1, c = b.length; a < c; a++) {
        this.lineTo(b[a].x, b[a].y)
    }
};
THREE.Path.prototype.moveTo = function(a, c) {
    var b = Array.prototype.slice.call(arguments);
    this.actions.push({
        action: THREE.PathActions.MOVE_TO,
        args: b
    })
};
THREE.Path.prototype.lineTo = function(a, g) {
    var b = Array.prototype.slice.call(arguments);
    var e = this.actions[this.actions.length - 1].args;
    var c = e[e.length - 2];
    var d = e[e.length - 1];
    var f = new THREE.LineCurve(new THREE.Vector2(c, d), new THREE.Vector2(a, g));
    this.curves.push(f);
    this.actions.push({
        action: THREE.PathActions.LINE_TO,
        args: b
    })
};
THREE.Path.prototype.quadraticCurveTo = function(e, b, g, f) {
    var h = Array.prototype.slice.call(arguments);
    var a = this.actions[this.actions.length - 1].args;
    var c = a[a.length - 2];
    var i = a[a.length - 1];
    var d = new THREE.QuadraticBezierCurve(new THREE.Vector2(c, i), new THREE.Vector2(e, b), new THREE.Vector2(g, f));
    this.curves.push(d);
    this.actions.push({
        action: THREE.PathActions.QUADRATIC_CURVE_TO,
        args: h
    })
};
THREE.Path.prototype.bezierCurveTo = function(e, c, k, j, g, f) {
    var h = Array.prototype.slice.call(arguments);
    var a = this.actions[this.actions.length - 1].args;
    var b = a[a.length - 2];
    var i = a[a.length - 1];
    var d = new THREE.CubicBezierCurve(new THREE.Vector2(b, i), new THREE.Vector2(e, c), new THREE.Vector2(k, j), new THREE.Vector2(g, f));
    this.curves.push(d);
    this.actions.push({
        action: THREE.PathActions.BEZIER_CURVE_TO,
        args: h
    })
};
THREE.Path.prototype.splineThru = function(g) {
    var a = Array.prototype.slice.call(arguments);
    var d = this.actions[this.actions.length - 1].args;
    var b = d[d.length - 2];
    var c = d[d.length - 1];
    var f = [new THREE.Vector2(b, c)];
    Array.prototype.push.apply(f, g);
    var e = new THREE.SplineCurve(f);
    this.curves.push(e);
    this.actions.push({
        action: THREE.PathActions.CSPLINE_THRU,
        args: a
    })
};
THREE.Path.prototype.arc = function(h, f, g, d, a, b) {
    var c = this.actions[this.actions.length - 1].args;
    var e = c[c.length - 2];
    var i = c[c.length - 1];
    this.absarc(h + e, f + i, g, d, a, b)
};
THREE.Path.prototype.absarc = function(e, d, f, c, b, a) {
    this.absellipse(e, d, f, f, c, b, a)
};
THREE.Path.prototype.ellipse = function(g, f, i, h, d, a, b) {
    var c = this.actions[this.actions.length - 1].args;
    var e = c[c.length - 2];
    var j = c[c.length - 1];
    this.absellipse(g + e, f + j, i, h, d, a, b)
};
THREE.Path.prototype.absellipse = function(f, e, j, g, c, a, b) {
    var h = Array.prototype.slice.call(arguments);
    var d = new THREE.EllipseCurve(f, e, j, g, c, a, b);
    this.curves.push(d);
    var i = d.getPoint(1);
    h.push(i.x);
    h.push(i.y);
    this.actions.push({
        action: THREE.PathActions.ELLIPSE,
        args: h
    })
};
THREE.Path.prototype.getSpacedPoints = function(b, d) {
    if (!b) {
        b = 40
    }
    var c = [];
    for (var a = 0; a < b; a++) {
        c.push(this.getPoint(a / b))
    }
    return c
};
THREE.Path.prototype.getPoints = function(S, Q) {
    if (this.useSpacedPoints) {
        return this.getSpacedPoints(S, Q)
    }
    S = S || 12;
    var E = [];
    var N, u, r, c, I;
    var F, C, R, v, T, A, a, B, b, M, H, L, K;
    for (N = 0, u = this.actions.length; N < u; N++) {
        r = this.actions[N];
        c = r.action;
        I = r.args;
        switch (c) {
            case THREE.PathActions.MOVE_TO:
                E.push(new THREE.Vector2(I[0], I[1]));
                break;
            case THREE.PathActions.LINE_TO:
                E.push(new THREE.Vector2(I[0], I[1]));
                break;
            case THREE.PathActions.QUADRATIC_CURVE_TO:
                F = I[2];
                C = I[3];
                T = I[0];
                A = I[1];
                if (E.length > 0) {
                    b = E[E.length - 1];
                    a = b.x;
                    B = b.y
                } else {
                    b = this.actions[N - 1].args;
                    a = b[b.length - 2];
                    B = b[b.length - 1]
                }
                for (M = 1; M <= S; M++) {
                    H = M / S;
                    L = THREE.Shape.Utils.b2(H, a, T, F);
                    K = THREE.Shape.Utils.b2(H, B, A, C);
                    E.push(new THREE.Vector2(L, K))
                }
                break;
            case THREE.PathActions.BEZIER_CURVE_TO:
                F = I[4];
                C = I[5];
                T = I[0];
                A = I[1];
                R = I[2];
                v = I[3];
                if (E.length > 0) {
                    b = E[E.length - 1];
                    a = b.x;
                    B = b.y
                } else {
                    b = this.actions[N - 1].args;
                    a = b[b.length - 2];
                    B = b[b.length - 1]
                }
                for (M = 1; M <= S; M++) {
                    H = M / S;
                    L = THREE.Shape.Utils.b3(H, a, T, R, F);
                    K = THREE.Shape.Utils.b3(H, B, A, v, C);
                    E.push(new THREE.Vector2(L, K))
                }
                break;
            case THREE.PathActions.CSPLINE_THRU:
                b = this.actions[N - 1].args;
                var k = new THREE.Vector2(b[b.length - 2], b[b.length - 1]);
                var f = [k];
                var J = S * I[0].length;
                f = f.concat(I[0]);
                var P = new THREE.SplineCurve(f);
                for (M = 1; M <= J; M++) {
                    E.push(P.getPointAt(M / J))
                }
                break;
            case THREE.PathActions.ARC:
                var o = I[0],
                    m = I[1],
                    p = I[2],
                    O = I[3],
                    G = I[4],
                    h = !!I[5];
                var D = G - O;
                var l;
                var d = S * 2;
                for (M = 1; M <= d; M++) {
                    H = M / d;
                    if (!h) {
                        H = 1 - H
                    }
                    l = O + H * D;
                    L = o + p * Math.cos(l);
                    K = m + p * Math.sin(l);
                    E.push(new THREE.Vector2(L, K))
                }
                break;
            case THREE.PathActions.ELLIPSE:
                var o = I[0],
                    m = I[1],
                    q = I[2],
                    s = I[3],
                    O = I[4],
                    G = I[5],
                    h = !!I[6];
                var D = G - O;
                var l;
                var d = S * 2;
                for (M = 1; M <= d; M++) {
                    H = M / d;
                    if (!h) {
                        H = 1 - H
                    }
                    l = O + H * D;
                    L = o + q * Math.cos(l);
                    K = m + s * Math.sin(l);
                    E.push(new THREE.Vector2(L, K))
                }
                break
        }
    }
    var e = E[E.length - 1];
    var g = 1e-10;
    if (Math.abs(e.x - E[0].x) < g && Math.abs(e.y - E[0].y) < g) {
        E.splice(E.length - 1, 1)
    }
    if (Q) {
        E.push(E[0])
    }
    return E
};
THREE.Path.prototype.toShapes = function(J, t) {
    function k(N) {
        var M, j, O, P, L;
        var R = [],
            Q = new THREE.Path();
        for (M = 0, j = N.length; M < j; M++) {
            O = N[M];
            L = O.args;
            P = O.action;
            if (P == THREE.PathActions.MOVE_TO) {
                if (Q.actions.length != 0) {
                    R.push(Q);
                    Q = new THREE.Path()
                }
            }
            Q[P].apply(Q, L)
        }
        if (Q.actions.length != 0) {
            R.push(Q)
        }
        return R
    }

    function m(M) {
        var j = [];
        for (var N = 0, L = M.length; N < L; N++) {
            var O = M[N];
            var P = new THREE.Shape();
            P.actions = O.actions;
            P.curves = O.curves;
            j.push(P)
        }
        return j
    }

    function q(T, M) {
        var N = 1e-10;
        var P = M.length;
        var O = false;
        for (var j = P - 1, i = 0; i < P; j = i++) {
            var L = M[j];
            var U = M[i];
            var S = U.x - L.x;
            var Q = U.y - L.y;
            if (Math.abs(Q) > N) {
                if (Q < 0) {
                    L = M[i];
                    S = -S;
                    U = M[j];
                    Q = -Q
                }
                if ((T.y < L.y) || (T.y > U.y)) {
                    continue
                }
                if (T.y == L.y) {
                    if (T.x == L.x) {
                        return true
                    }
                } else {
                    var R = Q * (T.x - L.x) - S * (T.y - L.y);
                    if (R == 0) {
                        return true
                    }
                    if (R < 0) {
                        continue
                    }
                    O = !O
                }
            } else {
                if (T.y != L.y) {
                    continue
                }
                if (((U.x <= T.x) && (T.x <= L.x)) || ((L.x <= T.x) && (T.x <= U.x))) {
                    return true
                }
            }
        }
        return O
    }
    var e = k(this.actions);
    if (e.length == 0) {
        return []
    }
    if (t === true) {
        return m(e)
    }
    var H, F, o, r = [];
    if (e.length == 1) {
        F = e[0];
        o = new THREE.Shape();
        o.actions = F.actions;
        o.curves = F.curves;
        r.push(o);
        return r
    }
    var a = !THREE.Shape.Utils.isClockWise(e[0].getPoints());
    a = J ? !a : a;
    var p = [];
    var B = [];
    var G = [];
    var h = 0;
    var u;
    B[h] = undefined;
    G[h] = [];
    var C, n;
    for (C = 0, n = e.length; C < n; C++) {
        F = e[C];
        u = F.getPoints();
        H = THREE.Shape.Utils.isClockWise(u);
        H = J ? !H : H;
        if (H) {
            if ((!a) && (B[h])) {
                h++
            }
            B[h] = {
                s: new THREE.Shape(),
                p: u
            };
            B[h].s.actions = F.actions;
            B[h].s.curves = F.curves;
            if (a) {
                h++
            }
            G[h] = []
        } else {
            G[h].push({
                h: F,
                p: u[0]
            })
        }
    }
    if (!B[0]) {
        return m(e)
    }
    if (B.length > 1) {
        var c = false;
        var v = [];
        for (var K = 0, d = B.length; K < d; K++) {
            p[K] = []
        }
        for (var K = 0, d = B.length; K < d; K++) {
            var I = B[K];
            var s = G[K];
            for (var l = 0; l < s.length; l++) {
                var b = s[l];
                var g = true;
                for (var f = 0; f < B.length; f++) {
                    if (q(b.p, B[f].p)) {
                        if (K != f) {
                            v.push({
                                froms: K,
                                tos: f,
                                hole: l
                            })
                        }
                        if (g) {
                            g = false;
                            p[f].push(b)
                        } else {
                            c = true
                        }
                    }
                }
                if (g) {
                    p[K].push(b)
                }
            }
        }
        if (v.length > 0) {
            if (!c) {
                G = p
            }
        }
    }
    var E, A, D;
    for (C = 0, n = B.length; C < n; C++) {
        o = B[C].s;
        r.push(o);
        E = G[C];
        for (A = 0, D = E.length; A < D; A++) {
            o.holes.push(E[A].h)
        }
    }
    return r
};
THREE.Shape = function() {
    THREE.Path.apply(this, arguments);
    this.holes = []
};
THREE.Shape.prototype = Object.create(THREE.Path.prototype);
THREE.Shape.prototype.constructor = THREE.Shape;
THREE.Shape.prototype.extrude = function(b) {
    var a = new THREE.ExtrudeGeometry(this, b);
    return a
};
THREE.Shape.prototype.makeGeometry = function(a) {
    var b = new THREE.ShapeGeometry(this, a);
    return b
};
THREE.Shape.prototype.getPointsHoles = function(c) {
    var b, a = this.holes.length,
        d = [];
    for (b = 0; b < a; b++) {
        d[b] = this.holes[b].getTransformedPoints(c, this.bends)
    }
    return d
};
THREE.Shape.prototype.getSpacedPointsHoles = function(c) {
    var b, a = this.holes.length,
        d = [];
    for (b = 0; b < a; b++) {
        d[b] = this.holes[b].getTransformedSpacedPoints(c, this.bends)
    }
    return d
};
THREE.Shape.prototype.extractAllPoints = function(a) {
    return {
        shape: this.getTransformedPoints(a),
        holes: this.getPointsHoles(a)
    }
};
THREE.Shape.prototype.extractPoints = function(a) {
    if (this.useSpacedPoints) {
        return this.extractAllSpacedPoints(a)
    }
    return this.extractAllPoints(a)
};
THREE.Shape.prototype.extractAllSpacedPoints = function(a) {
    return {
        shape: this.getTransformedSpacedPoints(a),
        holes: this.getSpacedPointsHoles(a)
    }
};
THREE.Shape.Utils = {
    triangulateShape: function(p, j) {
        function e(i, h, f) {
            if (i.x != h.x) {
                if (i.x < h.x) {
                    return ((i.x <= f.x) && (f.x <= h.x))
                } else {
                    return ((h.x <= f.x) && (f.x <= i.x))
                }
            } else {
                if (i.y < h.y) {
                    return ((i.y <= f.y) && (f.y <= h.y))
                } else {
                    return ((h.y <= f.y) && (f.y <= i.y))
                }
            }
        }

        function m(U, T, v, i, Q) {
            var J = 1e-10;
            var I = T.x - U.x,
                H = T.y - U.y;
            var S = i.x - v.x,
                R = i.y - v.y;
            var O = U.x - v.x;
            var N = U.y - v.y;
            var P = H * S - I * R;
            var F = H * O - I * N;
            if (Math.abs(P) > J) {
                var E;
                if (P > 0) {
                    if ((F < 0) || (F > P)) {
                        return []
                    }
                    E = R * O - S * N;
                    if ((E < 0) || (E > P)) {
                        return []
                    }
                } else {
                    if ((F > 0) || (F < P)) {
                        return []
                    }
                    E = R * O - S * N;
                    if ((E > 0) || (E < P)) {
                        return []
                    }
                }
                if (E == 0) {
                    if ((Q) && ((F == 0) || (F == P))) {
                        return []
                    }
                    return [U]
                }
                if (E == P) {
                    if ((Q) && ((F == 0) || (F == P))) {
                        return []
                    }
                    return [T]
                }
                if (F == 0) {
                    return [v]
                }
                if (F == P) {
                    return [i]
                }
                var h = E / P;
                return [{
                    x: U.x + h * I,
                    y: U.y + h * H
                }]
            } else {
                if ((F != 0) || (R * O != S * N)) {
                    return []
                }
                var K = ((I == 0) && (H == 0));
                var D = ((S == 0) && (R == 0));
                if (K && D) {
                    if ((U.x != v.x) || (U.y != v.y)) {
                        return []
                    }
                    return [U]
                }
                if (K) {
                    if (!e(v, i, U)) {
                        return []
                    }
                    return [U]
                }
                if (D) {
                    if (!e(U, T, v)) {
                        return []
                    }
                    return [v]
                }
                var V, f, M, G;
                var B, C, A, L;
                if (I != 0) {
                    if (U.x < T.x) {
                        V = U;
                        M = U.x;
                        f = T;
                        G = T.x
                    } else {
                        V = T;
                        M = T.x;
                        f = U;
                        G = U.x
                    }
                    if (v.x < i.x) {
                        B = v;
                        A = v.x;
                        C = i;
                        L = i.x
                    } else {
                        B = i;
                        A = i.x;
                        C = v;
                        L = v.x
                    }
                } else {
                    if (U.y < T.y) {
                        V = U;
                        M = U.y;
                        f = T;
                        G = T.y
                    } else {
                        V = T;
                        M = T.y;
                        f = U;
                        G = U.y
                    }
                    if (v.y < i.y) {
                        B = v;
                        A = v.y;
                        C = i;
                        L = i.y
                    } else {
                        B = i;
                        A = i.y;
                        C = v;
                        L = v.y
                    }
                }
                if (M <= A) {
                    if (G < A) {
                        return []
                    }
                    if (G == A) {
                        if (Q) {
                            return []
                        }
                        return [B]
                    }
                    if (G <= L) {
                        return [B, f]
                    }
                    return [B, C]
                } else {
                    if (M > L) {
                        return []
                    }
                    if (M == L) {
                        if (Q) {
                            return []
                        }
                        return [V]
                    }
                    if (G <= L) {
                        return [V, f]
                    }
                    return [V, C]
                }
            }
        }

        function s(A, F, i, H) {
            var v = 1e-10;
            var G = F.x - A.x,
                E = F.y - A.y;
            var J = i.x - A.x,
                I = i.y - A.y;
            var D = H.x - A.x,
                C = H.y - A.y;
            var h = G * I - E * J;
            var f = G * C - E * D;
            if (Math.abs(h) > v) {
                var B = D * I - C * J;
                if (h > 0) {
                    return ((f >= 0) && (B >= 0))
                } else {
                    return ((f >= 0) || (B >= 0))
                }
            } else {
                return (f > 0)
            }
        }

        function k(L, H) {
            var i = L.concat();
            var K;

            function M(Y, ab) {
                var X = i.length - 1;
                var aa = Y - 1;
                if (aa < 0) {
                    aa = X
                }
                var W = Y + 1;
                if (W > X) {
                    W = 0
                }
                var ac = s(i[Y], i[aa], i[W], K[ab]);
                if (!ac) {
                    return false
                }
                var Z = K.length - 1;
                var V = ab - 1;
                if (V < 0) {
                    V = Z
                }
                var h = ab + 1;
                if (h > Z) {
                    h = 0
                }
                ac = s(K[ab], K[V], K[h], i[Y]);
                if (!ac) {
                    return false
                }
                return true
            }

            function f(V, W) {
                var h, X, Y;
                for (h = 0; h < i.length; h++) {
                    X = h + 1;
                    X %= i.length;
                    Y = m(V, W, i[h], i[X], true);
                    if (Y.length > 0) {
                        return true
                    }
                }
                return false
            }
            var C = [];

            function O(V, W) {
                var X, aa, h, Y, Z;
                for (X = 0; X < C.length; X++) {
                    aa = H[C[X]];
                    for (h = 0; h < aa.length; h++) {
                        Y = h + 1;
                        Y %= aa.length;
                        Z = m(V, W, aa[h], aa[Y], true);
                        if (Z.length > 0) {
                            return true
                        }
                    }
                }
                return false
            }
            var I, F, U, R, S, P, B = [],
                T, Q, E, D;
            for (var N = 0, A = H.length; N < A; N++) {
                C.push(N)
            }
            var v = 0;
            var J = C.length * 2;
            while (C.length > 0) {
                J--;
                if (J < 0) {
                    break
                }
                for (F = v; F < i.length; F++) {
                    U = i[F];
                    I = -1;
                    for (var N = 0; N < C.length; N++) {
                        S = C[N];
                        P = U.x + ":" + U.y + ":" + S;
                        if (B[P] !== undefined) {
                            continue
                        }
                        K = H[S];
                        for (var G = 0; G < K.length; G++) {
                            R = K[G];
                            if (!M(F, G)) {
                                continue
                            }
                            if (f(U, R)) {
                                continue
                            }
                            if (O(U, R)) {
                                continue
                            }
                            I = G;
                            C.splice(N, 1);
                            T = i.slice(0, F + 1);
                            Q = i.slice(F);
                            E = K.slice(I);
                            D = K.slice(0, I + 1);
                            i = T.concat(E).concat(D).concat(Q);
                            v = F;
                            break
                        }
                        if (I >= 0) {
                            break
                        }
                        B[P] = true
                    }
                    if (I >= 0) {
                        break
                    }
                }
            }
            return i
        }
        var q, n, t, l, u, d, c = {};
        var g = p.concat();
        for (var r = 0, b = j.length; r < b; r++) {
            Array.prototype.push.apply(g, j[r])
        }
        for (q = 0, n = g.length; q < n; q++) {
            u = g[q].x + ":" + g[q].y;
            if (c[u] !== undefined) {}
            c[u] = q
        }
        var a = k(p, j);
        var o = THREE.FontUtils.Triangulate(a, false);
        for (q = 0, n = o.length; q < n; q++) {
            l = o[q];
            for (t = 0; t < 3; t++) {
                u = l[t].x + ":" + l[t].y;
                d = c[u];
                if (d !== undefined) {
                    l[t] = d
                }
            }
        }
        return o.concat()
    },
    isClockWise: function(a) {
        return THREE.FontUtils.Triangulate.area(a) < 0
    },
    b2p0: function(b, c) {
        var a = 1 - b;
        return a * a * c
    },
    b2p1: function(a, b) {
        return 2 * (1 - a) * a * b
    },
    b2p2: function(a, b) {
        return a * a * b
    },
    b2: function(a, d, c, b) {
        return this.b2p0(a, d) + this.b2p1(a, c) + this.b2p2(a, b)
    },
    b3p0: function(b, c) {
        var a = 1 - b;
        return a * a * a * c
    },
    b3p1: function(b, c) {
        var a = 1 - b;
        return 3 * a * a * b * c
    },
    b3p2: function(b, c) {
        var a = 1 - b;
        return 3 * a * b * b * c
    },
    b3p3: function(a, b) {
        return a * a * a * b
    },
    b3: function(a, e, d, c, b) {
        return this.b3p0(a, e) + this.b3p1(a, d) + this.b3p2(a, c) + this.b3p3(a, b)
    }
};
THREE.LineCurve = function(b, a) {
    this.v1 = b;
    this.v2 = a
};
THREE.LineCurve.prototype = Object.create(THREE.Curve.prototype);
THREE.LineCurve.prototype.constructor = THREE.LineCurve;
THREE.LineCurve.prototype.getPoint = function(b) {
    var a = this.v2.clone().sub(this.v1);
    a.multiplyScalar(b).add(this.v1);
    return a
};
THREE.LineCurve.prototype.getPointAt = function(a) {
    return this.getPoint(a)
};
THREE.LineCurve.prototype.getTangent = function(a) {
    var b = this.v2.clone().sub(this.v1);
    return b.normalize()
};
THREE.QuadraticBezierCurve = function(a, c, b) {
    this.v0 = a;
    this.v1 = c;
    this.v2 = b
};
THREE.QuadraticBezierCurve.prototype = Object.create(THREE.Curve.prototype);
THREE.QuadraticBezierCurve.prototype.constructor = THREE.QuadraticBezierCurve;
THREE.QuadraticBezierCurve.prototype.getPoint = function(b) {
    var a = new THREE.Vector2();
    a.x = THREE.Shape.Utils.b2(b, this.v0.x, this.v1.x, this.v2.x);
    a.y = THREE.Shape.Utils.b2(b, this.v0.y, this.v1.y, this.v2.y);
    return a
};
THREE.QuadraticBezierCurve.prototype.getTangent = function(b) {
    var a = new THREE.Vector2();
    a.x = THREE.Curve.Utils.tangentQuadraticBezier(b, this.v0.x, this.v1.x, this.v2.x);
    a.y = THREE.Curve.Utils.tangentQuadraticBezier(b, this.v0.y, this.v1.y, this.v2.y);
    return a.normalize()
};
THREE.CubicBezierCurve = function(a, d, c, b) {
    this.v0 = a;
    this.v1 = d;
    this.v2 = c;
    this.v3 = b
};
THREE.CubicBezierCurve.prototype = Object.create(THREE.Curve.prototype);
THREE.CubicBezierCurve.prototype.constructor = THREE.CubicBezierCurve;
THREE.CubicBezierCurve.prototype.getPoint = function(c) {
    var b, a;
    b = THREE.Shape.Utils.b3(c, this.v0.x, this.v1.x, this.v2.x, this.v3.x);
    a = THREE.Shape.Utils.b3(c, this.v0.y, this.v1.y, this.v2.y, this.v3.y);
    return new THREE.Vector2(b, a)
};
THREE.CubicBezierCurve.prototype.getTangent = function(c) {
    var b, a;
    b = THREE.Curve.Utils.tangentCubicBezier(c, this.v0.x, this.v1.x, this.v2.x, this.v3.x);
    a = THREE.Curve.Utils.tangentCubicBezier(c, this.v0.y, this.v1.y, this.v2.y, this.v3.y);
    var d = new THREE.Vector2(b, a);
    d.normalize();
    return d
};
THREE.SplineCurve = function(a) {
    this.points = (a == undefined) ? [] : a
};
THREE.SplineCurve.prototype = Object.create(THREE.Curve.prototype);
THREE.SplineCurve.prototype.constructor = THREE.SplineCurve;
THREE.SplineCurve.prototype.getPoint = function(j) {
    var i = this.points;
    var h = (i.length - 1) * j;
    var a = Math.floor(h);
    var c = h - a;
    var g = i[a == 0 ? a : a - 1];
    var f = i[a];
    var e = i[a > i.length - 2 ? i.length - 1 : a + 1];
    var d = i[a > i.length - 3 ? i.length - 1 : a + 2];
    var b = new THREE.Vector2();
    b.x = THREE.Curve.Utils.interpolate(g.x, f.x, e.x, d.x, c);
    b.y = THREE.Curve.Utils.interpolate(g.y, f.y, e.y, d.y, c);
    return b
};
THREE.EllipseCurve = function(f, e, g, a, d, c, b) {
    this.aX = f;
    this.aY = e;
    this.xRadius = g;
    this.yRadius = a;
    this.aStartAngle = d;
    this.aEndAngle = c;
    this.aClockwise = b
};
THREE.EllipseCurve.prototype = Object.create(THREE.Curve.prototype);
THREE.EllipseCurve.prototype.constructor = THREE.EllipseCurve;
THREE.EllipseCurve.prototype.getPoint = function(b) {
    var d = this.aEndAngle - this.aStartAngle;
    if (d < 0) {
        d += Math.PI * 2
    }
    if (d > Math.PI * 2) {
        d -= Math.PI * 2
    }
    var c;
    if (this.aClockwise === true) {
        c = this.aEndAngle + (1 - b) * (Math.PI * 2 - d)
    } else {
        c = this.aStartAngle + b * d
    }
    var a = new THREE.Vector2();
    a.x = this.aX + this.xRadius * Math.cos(c);
    a.y = this.aY + this.yRadius * Math.sin(c);
    return a
};
THREE.ArcCurve = function(e, d, f, c, b, a) {
    THREE.EllipseCurve.call(this, e, d, f, f, c, b, a)
};
THREE.ArcCurve.prototype = Object.create(THREE.EllipseCurve.prototype);
THREE.ArcCurve.prototype.constructor = THREE.ArcCurve;
THREE.LineCurve3 = THREE.Curve.create(function(b, a) {
    this.v1 = b;
    this.v2 = a
}, function(b) {
    var a = new THREE.Vector3();
    a.subVectors(this.v2, this.v1);
    a.multiplyScalar(b);
    a.add(this.v1);
    return a
});
THREE.QuadraticBezierCurve3 = THREE.Curve.create(function(a, c, b) {
    this.v0 = a;
    this.v1 = c;
    this.v2 = b
}, function(b) {
    var a = new THREE.Vector3();
    a.x = THREE.Shape.Utils.b2(b, this.v0.x, this.v1.x, this.v2.x);
    a.y = THREE.Shape.Utils.b2(b, this.v0.y, this.v1.y, this.v2.y);
    a.z = THREE.Shape.Utils.b2(b, this.v0.z, this.v1.z, this.v2.z);
    return a
});
THREE.CubicBezierCurve3 = THREE.Curve.create(function(a, d, c, b) {
    this.v0 = a;
    this.v1 = d;
    this.v2 = c;
    this.v3 = b
}, function(b) {
    var a = new THREE.Vector3();
    a.x = THREE.Shape.Utils.b3(b, this.v0.x, this.v1.x, this.v2.x, this.v3.x);
    a.y = THREE.Shape.Utils.b3(b, this.v0.y, this.v1.y, this.v2.y, this.v3.y);
    a.z = THREE.Shape.Utils.b3(b, this.v0.z, this.v1.z, this.v2.z, this.v3.z);
    return a
});
THREE.SplineCurve3 = THREE.Curve.create(function(a) {
    this.points = (a == undefined) ? [] : a
}, function(j) {
    var i = this.points;
    var h = (i.length - 1) * j;
    var a = Math.floor(h);
    var c = h - a;
    var g = i[a == 0 ? a : a - 1];
    var f = i[a];
    var e = i[a > i.length - 2 ? i.length - 1 : a + 1];
    var d = i[a > i.length - 3 ? i.length - 1 : a + 2];
    var b = new THREE.Vector3();
    b.x = THREE.Curve.Utils.interpolate(g.x, f.x, e.x, d.x, c);
    b.y = THREE.Curve.Utils.interpolate(g.y, f.y, e.y, d.y, c);
    b.z = THREE.Curve.Utils.interpolate(g.z, f.z, e.z, d.z, c);
    return b
});
THREE.ClosedSplineCurve3 = THREE.Curve.create(function(a) {
    this.points = (a == undefined) ? [] : a
}, function(j) {
    var i = this.points;
    var h = (i.length - 0) * j;
    var a = Math.floor(h);
    var c = h - a;
    a += a > 0 ? 0 : (Math.floor(Math.abs(a) / i.length) + 1) * i.length;
    var g = i[(a - 1) % i.length];
    var f = i[(a) % i.length];
    var e = i[(a + 1) % i.length];
    var d = i[(a + 2) % i.length];
    var b = new THREE.Vector3();
    b.x = THREE.Curve.Utils.interpolate(g.x, f.x, e.x, d.x, c);
    b.y = THREE.Curve.Utils.interpolate(g.y, f.y, e.y, d.y, c);
    b.z = THREE.Curve.Utils.interpolate(g.z, f.z, e.z, d.z, c);
    return b
});
THREE.AnimationHandler = {
    LINEAR: 0,
    CATMULLROM: 1,
    CATMULLROM_FORWARD: 2,
    add: function() {
        console.warn("THREE.AnimationHandler.add() has been deprecated.")
    },
    get: function() {
        console.warn("THREE.AnimationHandler.get() has been deprecated.")
    },
    remove: function() {
        console.warn("THREE.AnimationHandler.remove() has been deprecated.")
    },
    animations: [],
    init: function(g) {
        if (g.initialized === true) {
            return g
        }
        for (var c = 0; c < g.hierarchy.length; c++) {
            for (var b = 0; b < g.hierarchy[c].keys.length; b++) {
                if (g.hierarchy[c].keys[b].time < 0) {
                    g.hierarchy[c].keys[b].time = 0
                }
                if (g.hierarchy[c].keys[b].rot !== undefined && !(g.hierarchy[c].keys[b].rot instanceof THREE.Quaternion)) {
                    var f = g.hierarchy[c].keys[b].rot;
                    g.hierarchy[c].keys[b].rot = new THREE.Quaternion().fromArray(f)
                }
            }
            if (g.hierarchy[c].keys.length && g.hierarchy[c].keys[0].morphTargets !== undefined) {
                var e = {};
                for (var b = 0; b < g.hierarchy[c].keys.length; b++) {
                    for (var a = 0; a < g.hierarchy[c].keys[b].morphTargets.length; a++) {
                        var i = g.hierarchy[c].keys[b].morphTargets[a];
                        e[i] = -1
                    }
                }
                g.hierarchy[c].usedMorphTargets = e;
                for (var b = 0; b < g.hierarchy[c].keys.length; b++) {
                    var d = {};
                    for (var i in e) {
                        for (var a = 0; a < g.hierarchy[c].keys[b].morphTargets.length; a++) {
                            if (g.hierarchy[c].keys[b].morphTargets[a] === i) {
                                d[i] = g.hierarchy[c].keys[b].morphTargetsInfluences[a];
                                break
                            }
                        }
                        if (a === g.hierarchy[c].keys[b].morphTargets.length) {
                            d[i] = 0
                        }
                    }
                    g.hierarchy[c].keys[b].morphTargetsInfluences = d
                }
            }
            for (var b = 1; b < g.hierarchy[c].keys.length; b++) {
                if (g.hierarchy[c].keys[b].time === g.hierarchy[c].keys[b - 1].time) {
                    g.hierarchy[c].keys.splice(b, 1);
                    b--
                }
            }
            for (var b = 0; b < g.hierarchy[c].keys.length; b++) {
                g.hierarchy[c].keys[b].index = b
            }
        }
        g.initialized = true;
        return g
    },
    parse: function(c) {
        var e = function(b, f) {
            f.push(b);
            for (var g = 0; g < b.children.length; g++) {
                e(b.children[g], f)
            }
        };
        var d = [];
        if (c instanceof THREE.SkinnedMesh) {
            for (var a = 0; a < c.skeleton.bones.length; a++) {
                d.push(c.skeleton.bones[a])
            }
        } else {
            e(c, d)
        }
        return d
    },
    play: function(a) {
        if (this.animations.indexOf(a) === -1) {
            this.animations.push(a)
        }
    },
    stop: function(b) {
        var a = this.animations.indexOf(b);
        if (a !== -1) {
            this.animations.splice(a, 1)
        }
    },
    update: function(b) {
        for (var a = 0; a < this.animations.length; a++) {
            this.animations[a].resetBlendWeights()
        }
        for (var a = 0; a < this.animations.length; a++) {
            this.animations[a].update(b)
        }
    }
};
THREE.Animation = function(a, b) {
    this.root = a;
    this.data = THREE.AnimationHandler.init(b);
    this.hierarchy = THREE.AnimationHandler.parse(a);
    this.currentTime = 0;
    this.timeScale = 1;
    this.isPlaying = false;
    this.loop = true;
    this.weight = 0;
    this.interpolationType = THREE.AnimationHandler.LINEAR
};
THREE.Animation.prototype.keyTypes = ["pos", "rot", "scl"];
THREE.Animation.prototype.play = function(a, b) {
    this.currentTime = a !== undefined ? a : 0;
    this.weight = b !== undefined ? b : 1;
    this.isPlaying = true;
    this.reset();
    THREE.AnimationHandler.play(this)
};
THREE.Animation.prototype.stop = function() {
    this.isPlaying = false;
    THREE.AnimationHandler.stop(this)
};
THREE.Animation.prototype.reset = function() {
    for (var i = 0, b = this.hierarchy.length; i < b; i++) {
        var d = this.hierarchy[i];
        if (d.animationCache === undefined) {
            d.animationCache = {
                animations: {},
                blending: {
                    positionWeight: 0,
                    quaternionWeight: 0,
                    scaleWeight: 0
                }
            }
        }
        if (d.animationCache.animations[this.data.name] === undefined) {
            d.animationCache.animations[this.data.name] = {};
            d.animationCache.animations[this.data.name].prevKey = {
                pos: 0,
                rot: 0,
                scl: 0
            };
            d.animationCache.animations[this.data.name].nextKey = {
                pos: 0,
                rot: 0,
                scl: 0
            };
            d.animationCache.animations[this.data.name].originalMatrix = d.matrix
        }
        var c = d.animationCache.animations[this.data.name];
        for (var e = 0; e < 3; e++) {
            var g = this.keyTypes[e];
            var f = this.data.hierarchy[i].keys[0];
            var a = this.getNextKeyWith(g, i, 1);
            while (a.time < this.currentTime && a.index > f.index) {
                f = a;
                a = this.getNextKeyWith(g, i, a.index + 1)
            }
            c.prevKey[g] = f;
            c.nextKey[g] = a
        }
    }
};
THREE.Animation.prototype.resetBlendWeights = function() {
    for (var c = 0, a = this.hierarchy.length; c < a; c++) {
        var b = this.hierarchy[c];
        if (b.animationCache !== undefined) {
            b.animationCache.blending.positionWeight = 0;
            b.animationCache.blending.quaternionWeight = 0;
            b.animationCache.blending.scaleWeight = 0
        }
    }
};
THREE.Animation.prototype.update = (function() {
    var d = [];
    var f = new THREE.Vector3();
    var a = new THREE.Vector3();
    var c = new THREE.Quaternion();
    var e = function(s, h) {
        var m = [],
            o = [],
            r, g, k, j, i, q, p, n, l;
        r = (s.length - 1) * h;
        g = Math.floor(r);
        k = r - g;
        m[0] = g === 0 ? g : g - 1;
        m[1] = g;
        m[2] = g > s.length - 2 ? g : g + 1;
        m[3] = g > s.length - 3 ? g : g + 2;
        q = s[m[0]];
        p = s[m[1]];
        n = s[m[2]];
        l = s[m[3]];
        j = k * k;
        i = k * j;
        o[0] = b(q[0], p[0], n[0], l[0], k, j, i);
        o[1] = b(q[1], p[1], n[1], l[1], k, j, i);
        o[2] = b(q[2], p[2], n[2], l[2], k, j, i);
        return o
    };
    var b = function(n, m, k, j, o, h, g) {
        var l = (k - n) * 0.5,
            i = (j - m) * 0.5;
        return (2 * (m - k) + l + i) * g + (-3 * (m - k) - 2 * l - i) * h + l * o + m
    };
    return function(A) {
        if (this.isPlaying === false) {
            return
        }
        this.currentTime += A * this.timeScale;
        if (this.weight === 0) {
            return
        }
        var g = this.data.length;
        if (this.currentTime > g || this.currentTime < 0) {
            if (this.loop) {
                this.currentTime %= g;
                if (this.currentTime < 0) {
                    this.currentTime += g
                }
                this.reset()
            } else {
                this.stop()
            }
        }
        for (var u = 0, j = this.hierarchy.length; u < j; u++) {
            var D = this.hierarchy[u];
            var q = D.animationCache.animations[this.data.name];
            var n = D.animationCache.blending;
            for (var p = 0; p < 3; p++) {
                var l = this.keyTypes[p];
                var C = q.prevKey[l];
                var m = q.nextKey[l];
                if ((this.timeScale > 0 && m.time <= this.currentTime) || (this.timeScale < 0 && C.time >= this.currentTime)) {
                    C = this.data.hierarchy[u].keys[0];
                    m = this.getNextKeyWith(l, u, 1);
                    while (m.time < this.currentTime && m.index > C.index) {
                        C = m;
                        m = this.getNextKeyWith(l, u, m.index + 1)
                    }
                    q.prevKey[l] = C;
                    q.nextKey[l] = m
                }
                var E = (this.currentTime - C.time) / (m.time - C.time);
                var r = C[l];
                var k = m[l];
                if (E < 0) {
                    E = 0
                }
                if (E > 1) {
                    E = 1
                }
                if (l === "pos") {
                    if (this.interpolationType === THREE.AnimationHandler.LINEAR) {
                        a.x = r[0] + (k[0] - r[0]) * E;
                        a.y = r[1] + (k[1] - r[1]) * E;
                        a.z = r[2] + (k[2] - r[2]) * E;
                        var s = this.weight / (this.weight + n.positionWeight);
                        D.position.lerp(a, s);
                        n.positionWeight += this.weight
                    } else {
                        if (this.interpolationType === THREE.AnimationHandler.CATMULLROM || this.interpolationType === THREE.AnimationHandler.CATMULLROM_FORWARD) {
                            d[0] = this.getPrevKeyWith("pos", u, C.index - 1)["pos"];
                            d[1] = r;
                            d[2] = k;
                            d[3] = this.getNextKeyWith("pos", u, m.index + 1)["pos"];
                            E = E * 0.33 + 0.33;
                            var o = e(d, E);
                            var s = this.weight / (this.weight + n.positionWeight);
                            n.positionWeight += this.weight;
                            var i = D.position;
                            i.x = i.x + (o[0] - i.x) * s;
                            i.y = i.y + (o[1] - i.y) * s;
                            i.z = i.z + (o[2] - i.z) * s;
                            if (this.interpolationType === THREE.AnimationHandler.CATMULLROM_FORWARD) {
                                var B = e(d, E * 1.01);
                                f.set(B[0], B[1], B[2]);
                                f.sub(i);
                                f.y = 0;
                                f.normalize();
                                var v = Math.atan2(f.x, f.z);
                                D.rotation.set(0, v, 0)
                            }
                        }
                    }
                } else {
                    if (l === "rot") {
                        THREE.Quaternion.slerp(r, k, c, E);
                        if (n.quaternionWeight === 0) {
                            D.quaternion.copy(c);
                            n.quaternionWeight = this.weight
                        } else {
                            var s = this.weight / (this.weight + n.quaternionWeight);
                            THREE.Quaternion.slerp(D.quaternion, c, D.quaternion, s);
                            n.quaternionWeight += this.weight
                        }
                    } else {
                        if (l === "scl") {
                            a.x = r[0] + (k[0] - r[0]) * E;
                            a.y = r[1] + (k[1] - r[1]) * E;
                            a.z = r[2] + (k[2] - r[2]) * E;
                            var s = this.weight / (this.weight + n.scaleWeight);
                            D.scale.lerp(a, s);
                            n.scaleWeight += this.weight
                        }
                    }
                }
            }
        }
        return true
    }
})();
THREE.Animation.prototype.getNextKeyWith = function(c, b, a) {
    var d = this.data.hierarchy[b].keys;
    if (this.interpolationType === THREE.AnimationHandler.CATMULLROM || this.interpolationType === THREE.AnimationHandler.CATMULLROM_FORWARD) {
        a = a < d.length - 1 ? a : d.length - 1
    } else {
        a = a % d.length
    }
    for (; a < d.length; a++) {
        if (d[a][c] !== undefined) {
            return d[a]
        }
    }
    return this.data.hierarchy[b].keys[0]
};
THREE.Animation.prototype.getPrevKeyWith = function(c, b, a) {
    var d = this.data.hierarchy[b].keys;
    if (this.interpolationType === THREE.AnimationHandler.CATMULLROM || this.interpolationType === THREE.AnimationHandler.CATMULLROM_FORWARD) {
        a = a > 0 ? a : 0
    } else {
        a = a >= 0 ? a : a + d.length
    }
    for (; a >= 0; a--) {
        if (d[a][c] !== undefined) {
            return d[a]
        }
    }
    return this.data.hierarchy[b].keys[d.length - 1]
};
THREE.KeyFrameAnimation = function(e) {
    this.root = e.node;
    this.data = THREE.AnimationHandler.init(e);
    this.hierarchy = THREE.AnimationHandler.parse(this.root);
    this.currentTime = 0;
    this.timeScale = 0.001;
    this.isPlaying = false;
    this.isPaused = true;
    this.loop = true;
    for (var g = 0, c = this.hierarchy.length; g < c; g++) {
        var i = this.data.hierarchy[g].keys,
            a = this.data.hierarchy[g].sids,
            d = this.hierarchy[g];
        if (i.length && a) {
            for (var j = 0; j < a.length; j++) {
                var b = a[j],
                    f = this.getNextKeyWith(b, g, 0);
                if (f) {
                    f.apply(b)
                }
            }
            d.matrixAutoUpdate = false;
            this.data.hierarchy[g].node.updateMatrix();
            d.matrixWorldNeedsUpdate = true
        }
    }
};
THREE.KeyFrameAnimation.prototype.play = function(d) {
    this.currentTime = d !== undefined ? d : 0;
    if (this.isPlaying === false) {
        this.isPlaying = true;
        var c, a = this.hierarchy.length,
            b, f;
        for (c = 0; c < a; c++) {
            b = this.hierarchy[c];
            f = this.data.hierarchy[c];
            if (f.animationCache === undefined) {
                f.animationCache = {};
                f.animationCache.prevKey = null;
                f.animationCache.nextKey = null;
                f.animationCache.originalMatrix = b.matrix
            }
            var e = this.data.hierarchy[c].keys;
            if (e.length) {
                f.animationCache.prevKey = e[0];
                f.animationCache.nextKey = e[1];
                this.startTime = Math.min(e[0].time, this.startTime);
                this.endTime = Math.max(e[e.length - 1].time, this.endTime)
            }
        }
        this.update(0)
    }
    this.isPaused = false;
    THREE.AnimationHandler.play(this)
};
THREE.KeyFrameAnimation.prototype.stop = function() {
    this.isPlaying = false;
    this.isPaused = false;
    THREE.AnimationHandler.stop(this);
    for (var b = 0; b < this.data.hierarchy.length; b++) {
        var d = this.hierarchy[b];
        var c = this.data.hierarchy[b];
        if (c.animationCache !== undefined) {
            var a = c.animationCache.originalMatrix;
            a.copy(d.matrix);
            d.matrix = a;
            delete c.animationCache
        }
    }
};
THREE.KeyFrameAnimation.prototype.update = function(i) {
    if (this.isPlaying === false) {
        return
    }
    this.currentTime += i * this.timeScale;
    var d = this.data.length;
    if (this.loop === true && this.currentTime > d) {
        this.currentTime %= d
    }
    this.currentTime = Math.min(this.currentTime, d);
    for (var f = 0, b = this.hierarchy.length; f < b; f++) {
        var e = this.hierarchy[f];
        var c = this.data.hierarchy[f];
        var j = c.keys,
            a = c.animationCache;
        if (j.length) {
            var k = a.prevKey;
            var g = a.nextKey;
            if (g.time <= this.currentTime) {
                while (g.time < this.currentTime && g.index > k.index) {
                    k = g;
                    g = j[k.index + 1]
                }
                a.prevKey = k;
                a.nextKey = g
            }
            if (g.time >= this.currentTime) {
                k.interpolate(g, this.currentTime)
            } else {
                k.interpolate(g, g.time)
            }
            this.data.hierarchy[f].node.updateMatrix();
            e.matrixWorldNeedsUpdate = true
        }
    }
};
THREE.KeyFrameAnimation.prototype.getNextKeyWith = function(a, c, b) {
    var d = this.data.hierarchy[c].keys;
    b = b % d.length;
    for (; b < d.length; b++) {
        if (d[b].hasTarget(a)) {
            return d[b]
        }
    }
    return d[0]
};
THREE.KeyFrameAnimation.prototype.getPrevKeyWith = function(a, c, b) {
    var d = this.data.hierarchy[c].keys;
    b = b >= 0 ? b : b + d.length;
    for (; b >= 0; b--) {
        if (d[b].hasTarget(a)) {
            return d[b]
        }
    }
    return d[d.length - 1]
};
THREE.MorphAnimation = function(a) {
    this.mesh = a;
    this.frames = a.morphTargetInfluences.length;
    this.currentTime = 0;
    this.duration = 1000;
    this.loop = true;
    this.lastFrame = 0;
    this.currentFrame = 0;
    this.isPlaying = false
};
THREE.MorphAnimation.prototype = {
    constructor: THREE.MorphAnimation,
    play: function() {
        this.isPlaying = true
    },
    pause: function() {
        this.isPlaying = false
    },
    update: function(c) {
        if (this.isPlaying === false) {
            return
        }
        this.currentTime += c;
        if (this.loop === true && this.currentTime > this.duration) {
            this.currentTime %= this.duration
        }
        this.currentTime = Math.min(this.currentTime, this.duration);
        var a = this.duration / this.frames;
        var b = Math.floor(this.currentTime / a);
        if (b != this.currentFrame) {
            this.mesh.morphTargetInfluences[this.lastFrame] = 0;
            this.mesh.morphTargetInfluences[this.currentFrame] = 1;
            this.mesh.morphTargetInfluences[b] = 0;
            this.lastFrame = this.currentFrame;
            this.currentFrame = b
        }
        this.mesh.morphTargetInfluences[b] = (this.currentTime % a) / a;
        this.mesh.morphTargetInfluences[this.lastFrame] = 1 - this.mesh.morphTargetInfluences[b]
    }
};
THREE.BoxGeometry = function(a, i, e, b, h, d) {
    THREE.Geometry.call(this);
    this.type = "BoxGeometry";
    this.parameters = {
        width: a,
        height: i,
        depth: e,
        widthSegments: b,
        heightSegments: h,
        depthSegments: d
    };
    this.widthSegments = b || 1;
    this.heightSegments = h || 1;
    this.depthSegments = d || 1;
    var k = this;
    var j = a / 2;
    var g = i / 2;
    var c = e / 2;
    f("z", "y", -1, -1, e, i, j, 0);
    f("z", "y", 1, -1, e, i, -j, 1);
    f("x", "z", 1, 1, a, e, g, 2);
    f("x", "z", 1, -1, a, e, -g, 3);
    f("x", "y", 1, -1, a, i, c, 4);
    f("x", "y", -1, -1, a, i, -c, 5);

    function f(E, D, l, s, G, F, V, A) {
        var C, q, p, K = k.widthSegments,
            I = k.heightSegments,
            r = G / 2,
            o = F / 2,
            t = k.vertices.length;
        if ((E === "x" && D === "y") || (E === "y" && D === "x")) {
            C = "z"
        } else {
            if ((E === "x" && D === "z") || (E === "z" && D === "x")) {
                C = "y";
                I = k.depthSegments
            } else {
                if ((E === "z" && D === "y") || (E === "y" && D === "z")) {
                    C = "x";
                    K = k.depthSegments
                }
            }
        }
        var M = K + 1,
            n = I + 1,
            U = G / K,
            P = F / I,
            T = new THREE.Vector3();
        T[C] = V > 0 ? 1 : -1;
        for (p = 0; p < n; p++) {
            for (q = 0; q < M; q++) {
                var m = new THREE.Vector3();
                m[E] = (q * U - r) * l;
                m[D] = (p * P - o) * s;
                m[C] = V;
                k.vertices.push(m)
            }
        }
        for (p = 0; p < I; p++) {
            for (q = 0; q < K; q++) {
                var S = q + M * p;
                var R = q + M * (p + 1);
                var Q = (q + 1) + M * (p + 1);
                var O = (q + 1) + M * p;
                var N = new THREE.Vector2(q / K, 1 - p / I);
                var L = new THREE.Vector2(q / K, 1 - (p + 1) / I);
                var J = new THREE.Vector2((q + 1) / K, 1 - (p + 1) / I);
                var H = new THREE.Vector2((q + 1) / K, 1 - p / I);
                var B = new THREE.Face3(S + t, R + t, O + t);
                B.normal.copy(T);
                B.vertexNormals.push(T.clone(), T.clone(), T.clone());
                B.materialIndex = A;
                k.faces.push(B);
                k.faceVertexUvs[0].push([N, L, H]);
                B = new THREE.Face3(R + t, Q + t, O + t);
                B.normal.copy(T);
                B.vertexNormals.push(T.clone(), T.clone(), T.clone());
                B.materialIndex = A;
                k.faces.push(B);
                k.faceVertexUvs[0].push([L.clone(), J, H.clone()])
            }
        }
    }
    this.mergeVertices()
};
THREE.BoxGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.BoxGeometry.prototype.constructor = THREE.BoxGeometry;
THREE.CircleGeometry = function(k, g, d, b) {
    THREE.Geometry.call(this);
    this.type = "CircleGeometry";
    this.parameters = {
        radius: k,
        segments: g,
        thetaStart: d,
        thetaLength: b
    };
    k = k || 50;
    g = g !== undefined ? Math.max(3, g) : 8;
    d = d !== undefined ? d : 0;
    b = b !== undefined ? b : Math.PI * 2;
    var f, e = [],
        a = new THREE.Vector3(),
        l = new THREE.Vector2(0.5, 0.5);
    this.vertices.push(a);
    e.push(l);
    for (f = 0; f <= g; f++) {
        var j = new THREE.Vector3();
        var h = d + f / g * b;
        j.x = k * Math.cos(h);
        j.y = k * Math.sin(h);
        this.vertices.push(j);
        e.push(new THREE.Vector2((j.x / k + 1) / 2, (j.y / k + 1) / 2))
    }
    var c = new THREE.Vector3(0, 0, 1);
    for (f = 1; f <= g; f++) {
        this.faces.push(new THREE.Face3(f, f + 1, 0, [c.clone(), c.clone(), c.clone()]));
        this.faceVertexUvs[0].push([e[f].clone(), e[f + 1].clone(), l.clone()])
    }
    this.computeFaceNormals();
    this.boundingSphere = new THREE.Sphere(new THREE.Vector3(), k)
};
THREE.CircleGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.CircleGeometry.prototype.constructor = THREE.CircleGeometry;
THREE.CubeGeometry = function(c, a, f, e, d, b) {
    console.warn("THREE.CubeGeometry has been renamed to THREE.BoxGeometry.");
    return new THREE.BoxGeometry(c, a, f, e, d, b)
};
THREE.CylinderGeometry = function(l, N, C, e, A, K, g, D) {
    THREE.Geometry.call(this);
    this.type = "CylinderGeometry";
    this.parameters = {
        radiusTop: l,
        radiusBottom: N,
        height: C,
        radialSegments: e,
        heightSegments: A,
        openEnded: K,
        thetaStart: g,
        thetaLength: D
    };
    l = l !== undefined ? l : 20;
    N = N !== undefined ? N : 20;
    C = C !== undefined ? C : 100;
    e = e || 8;
    A = A || 1;
    K = K !== undefined ? K : false;
    g = g !== undefined ? g : 0;
    D = D !== undefined ? D : 2 * Math.PI;
    var E = C / 2;
    var q, p, h = [],
        r = [];
    for (p = 0; p <= A; p++) {
        var B = [];
        var M = [];
        var s = p / A;
        var f = s * (N - l) + l;
        for (q = 0; q <= e; q++) {
            var t = q / e;
            var I = new THREE.Vector3();
            I.x = f * Math.sin(t * D + g);
            I.y = -s * C + E;
            I.z = f * Math.cos(t * D + g);
            this.vertices.push(I);
            B.push(this.vertices.length - 1);
            M.push(new THREE.Vector2(t, 1 - s))
        }
        h.push(B);
        r.push(M)
    }
    var G = (N - l) / C;
    var n, k;
    for (q = 0; q < e; q++) {
        if (l !== 0) {
            n = this.vertices[h[0][q]].clone();
            k = this.vertices[h[0][q + 1]].clone()
        } else {
            n = this.vertices[h[1][q]].clone();
            k = this.vertices[h[1][q + 1]].clone()
        }
        n.setY(Math.sqrt(n.x * n.x + n.z * n.z) * G).normalize();
        k.setY(Math.sqrt(k.x * k.x + k.z * k.z) * G).normalize();
        for (p = 0; p < A; p++) {
            var d = h[p][q];
            var c = h[p + 1][q];
            var b = h[p + 1][q + 1];
            var a = h[p][q + 1];
            var o = n.clone();
            var m = n.clone();
            var j = k.clone();
            var i = k.clone();
            var L = r[p][q].clone();
            var J = r[p + 1][q].clone();
            var H = r[p + 1][q + 1].clone();
            var F = r[p][q + 1].clone();
            this.faces.push(new THREE.Face3(d, c, a, [o, m, i]));
            this.faceVertexUvs[0].push([L, J, F]);
            this.faces.push(new THREE.Face3(c, b, a, [m.clone(), j, i.clone()]));
            this.faceVertexUvs[0].push([J.clone(), H, F.clone()])
        }
    }
    if (K === false && l > 0) {
        this.vertices.push(new THREE.Vector3(0, E, 0));
        for (q = 0; q < e; q++) {
            var d = h[0][q];
            var c = h[0][q + 1];
            var b = this.vertices.length - 1;
            var o = new THREE.Vector3(0, 1, 0);
            var m = new THREE.Vector3(0, 1, 0);
            var j = new THREE.Vector3(0, 1, 0);
            var L = r[0][q].clone();
            var J = r[0][q + 1].clone();
            var H = new THREE.Vector2(J.x, 0);
            this.faces.push(new THREE.Face3(d, c, b, [o, m, j]));
            this.faceVertexUvs[0].push([L, J, H])
        }
    }
    if (K === false && N > 0) {
        this.vertices.push(new THREE.Vector3(0, -E, 0));
        for (q = 0; q < e; q++) {
            var d = h[A][q + 1];
            var c = h[A][q];
            var b = this.vertices.length - 1;
            var o = new THREE.Vector3(0, -1, 0);
            var m = new THREE.Vector3(0, -1, 0);
            var j = new THREE.Vector3(0, -1, 0);
            var L = r[A][q + 1].clone();
            var J = r[A][q].clone();
            var H = new THREE.Vector2(J.x, 1);
            this.faces.push(new THREE.Face3(d, c, b, [o, m, j]));
            this.faceVertexUvs[0].push([L, J, H])
        }
    }
    this.computeFaceNormals()
};
THREE.CylinderGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.CylinderGeometry.prototype.constructor = THREE.CylinderGeometry;
THREE.ExtrudeGeometry = function(a, b) {
    if (typeof(a) === "undefined") {
        a = [];
        return
    }
    THREE.Geometry.call(this);
    this.type = "ExtrudeGeometry";
    a = a instanceof Array ? a : [a];
    this.addShapeList(a, b);
    this.computeFaceNormals()
};
THREE.ExtrudeGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.ExtrudeGeometry.prototype.constructor = THREE.ExtrudeGeometry;
THREE.ExtrudeGeometry.prototype.addShapeList = function(b, d) {
    var a = b.length;
    for (var e = 0; e < a; e++) {
        var c = b[e];
        this.addShape(c, d)
    }
};
THREE.ExtrudeGeometry.prototype.addShape = function(F, O) {
    var g = O.amount !== undefined ? O.amount : 100;
    var f = O.bevelThickness !== undefined ? O.bevelThickness : 6;
    var P = O.bevelSize !== undefined ? O.bevelSize : f - 2;
    var C = O.bevelSegments !== undefined ? O.bevelSegments : 3;
    var a = O.bevelEnabled !== undefined ? O.bevelEnabled : true;
    var N = O.curveSegments !== undefined ? O.curveSegments : 12;
    var X = O.steps !== undefined ? O.steps : 1;
    var r = O.extrudePath;
    var T, u = false;
    var ak = O.material;
    var o = O.extrudeMaterial;
    var E = O.UVGenerator !== undefined ? O.UVGenerator : THREE.ExtrudeGeometry.WorldUVGenerator;
    var B, aa, ad, at;
    if (r) {
        T = r.getSpacedPoints(X);
        u = true;
        a = false;
        B = O.frames !== undefined ? O.frames : new THREE.TubeGeometry.FrenetFrames(r, X, false);
        aa = new THREE.Vector3();
        ad = new THREE.Vector3();
        at = new THREE.Vector3()
    }
    if (!a) {
        C = 0;
        f = 0;
        P = 0
    }
    var aw, aq, ar;
    var Y = this;
    var L = [];
    var V = this.vertices.length;
    var D = F.extractPoints(N);
    var d = D.shape;
    var J = D.holes;
    var ag = !THREE.Shape.Utils.isClockWise(d);
    if (ag) {
        d = d.reverse();
        for (aq = 0, ar = J.length; aq < ar; aq++) {
            aw = J[aq];
            if (THREE.Shape.Utils.isClockWise(aw)) {
                J[aq] = aw.reverse()
            }
        }
        ag = false
    }
    var q = THREE.Shape.Utils.triangulateShape(d, J);
    var aj = d;
    for (aq = 0, ar = J.length; aq < ar; aq++) {
        aw = J[aq];
        d = d.concat(aw)
    }

    function Q(i, h, b) {
        if (!h) {
            return h.clone().multiplyScalar(b).add(i)
        }
    }
    var av, ah, ae, Z, A, ai = d.length,
        p, n = q.length,
        W, c = aj.length;
    var U = 180 / Math.PI;

    function H(j, az, aA) {
        var aB = 1e-10;
        var aG, aE, aH = 1;
        var ay = j.x - az.x,
            ax = j.y - az.y;
        var aJ = aA.x - j.x,
            aI = aA.y - j.y;
        var v = (ay * ay + ax * ax);
        var aF = (ay * aI - ax * aJ);
        if (Math.abs(aF) > aB) {
            var aC = Math.sqrt(v);
            var b = Math.sqrt(aJ * aJ + aI * aI);
            var t = (az.x - ax / aC);
            var s = (az.y + ay / aC);
            var i = (aA.x - aI / b);
            var h = (aA.y + aJ / b);
            var aK = ((i - t) * aI - (h - s) * aJ) / (ay * aI - ax * aJ);
            aG = (t + ay * aK - j.x);
            aE = (s + ax * aK - j.y);
            var aD = (aG * aG + aE * aE);
            if (aD <= 2) {
                return new THREE.Vector2(aG, aE)
            } else {
                aH = Math.sqrt(aD / 2)
            }
        } else {
            var k = false;
            if (ay > aB) {
                if (aJ > aB) {
                    k = true
                }
            } else {
                if (ay < -aB) {
                    if (aJ < -aB) {
                        k = true
                    }
                } else {
                    if (Math.sign(ax) == Math.sign(aI)) {
                        k = true
                    }
                }
            }
            if (k) {
                aG = -ax;
                aE = ay;
                aH = Math.sqrt(v)
            } else {
                aG = ay;
                aE = ax;
                aH = Math.sqrt(v / 2)
            }
        }
        return new THREE.Vector2(aG / aH, aE / aH)
    }
    var an = [];
    for (var ap = 0, S = aj.length, am = S - 1, al = ap + 1; ap < S; ap++, am++, al++) {
        if (am === S) {
            am = 0
        }
        if (al === S) {
            al = 0
        }
        var K = aj[ap];
        var I = aj[am];
        var G = aj[al];
        an[ap] = H(aj[ap], aj[am], aj[al])
    }
    var R = [],
        ac, e = an.concat();
    for (aq = 0, ar = J.length; aq < ar; aq++) {
        aw = J[aq];
        ac = [];
        for (ap = 0, S = aw.length, am = S - 1, al = ap + 1; ap < S; ap++, am++, al++) {
            if (am === S) {
                am = 0
            }
            if (al === S) {
                al = 0
            }
            ac[ap] = H(aw[ap], aw[am], aw[al])
        }
        R.push(ac);
        e = e.concat(ac)
    }
    for (av = 0; av < C; av++) {
        ae = av / C;
        Z = f * (1 - ae);
        ah = P * (Math.sin(ae * Math.PI / 2));
        for (ap = 0, S = aj.length; ap < S; ap++) {
            A = Q(aj[ap], an[ap], ah);
            ab(A.x, A.y, -Z)
        }
        for (aq = 0, ar = J.length; aq < ar; aq++) {
            aw = J[aq];
            ac = R[aq];
            for (ap = 0, S = aw.length; ap < S; ap++) {
                A = Q(aw[ap], ac[ap], ah);
                ab(A.x, A.y, -Z)
            }
        }
    }
    ah = P;
    for (ap = 0; ap < ai; ap++) {
        A = a ? Q(d[ap], e[ap], ah) : d[ap];
        if (!u) {
            ab(A.x, A.y, 0)
        } else {
            ad.copy(B.normals[0]).multiplyScalar(A.x);
            aa.copy(B.binormals[0]).multiplyScalar(A.y);
            at.copy(T[0]).add(ad).add(aa);
            ab(at.x, at.y, at.z)
        }
    }
    var af;
    for (af = 1; af <= X; af++) {
        for (ap = 0; ap < ai; ap++) {
            A = a ? Q(d[ap], e[ap], ah) : d[ap];
            if (!u) {
                ab(A.x, A.y, g / X * af)
            } else {
                ad.copy(B.normals[af]).multiplyScalar(A.x);
                aa.copy(B.binormals[af]).multiplyScalar(A.y);
                at.copy(T[af]).add(ad).add(aa);
                ab(at.x, at.y, at.z)
            }
        }
    }
    for (av = C - 1; av >= 0; av--) {
        ae = av / C;
        Z = f * (1 - ae);
        ah = P * Math.sin(ae * Math.PI / 2);
        for (ap = 0, S = aj.length; ap < S; ap++) {
            A = Q(aj[ap], an[ap], ah);
            ab(A.x, A.y, g + Z)
        }
        for (aq = 0, ar = J.length; aq < ar; aq++) {
            aw = J[aq];
            ac = R[aq];
            for (ap = 0, S = aw.length; ap < S; ap++) {
                A = Q(aw[ap], ac[ap], ah);
                if (!u) {
                    ab(A.x, A.y, g + Z)
                } else {
                    ab(A.x, A.y + T[X - 1].y, T[X - 1].x + Z)
                }
            }
        }
    }
    M();
    au();

    function M() {
        if (a) {
            var b = 0;
            var h = ai * b;
            for (ap = 0; ap < n; ap++) {
                p = q[ap];
                m(p[2] + h, p[1] + h, p[0] + h)
            }
            b = X + C * 2;
            h = ai * b;
            for (ap = 0; ap < n; ap++) {
                p = q[ap];
                m(p[0] + h, p[1] + h, p[2] + h)
            }
        } else {
            for (ap = 0; ap < n; ap++) {
                p = q[ap];
                m(p[2], p[1], p[0])
            }
            for (ap = 0; ap < n; ap++) {
                p = q[ap];
                m(p[0] + ai * X, p[1] + ai * X, p[2] + ai * X)
            }
        }
    }

    function au() {
        var b = 0;
        ao(aj, b);
        b += aj.length;
        for (aq = 0, ar = J.length; aq < ar; aq++) {
            aw = J[aq];
            ao(aw, b);
            b += aw.length
        }
    }

    function ao(az, h) {
        var ax, v;
        ap = az.length;
        while (--ap >= 0) {
            ax = ap;
            v = ap - 1;
            if (v < 0) {
                v = az.length - 1
            }
            var aE = 0,
                i = X + C * 2;
            for (aE = 0; aE < i; aE++) {
                var ay = ai * aE;
                var t = ai * (aE + 1);
                var aD = h + ax + ay,
                    aC = h + v + ay,
                    aB = h + v + t,
                    aA = h + ax + t;
                l(aD, aC, aB, aA, az, aE, i, ax, v)
            }
        }
    }

    function ab(b, i, h) {
        Y.vertices.push(new THREE.Vector3(b, i, h))
    }

    function m(i, h, k) {
        i += V;
        h += V;
        k += V;
        Y.faces.push(new THREE.Face3(i, h, k, null, null, ak));
        var j = E.generateTopUV(Y, i, h, k);
        Y.faceVertexUvs[0].push(j)
    }

    function l(ay, ax, t, s, h, j, az, v, k) {
        ay += V;
        ax += V;
        t += V;
        s += V;
        Y.faces.push(new THREE.Face3(ay, ax, s, null, null, o));
        Y.faces.push(new THREE.Face3(ax, t, s, null, null, o));
        var i = E.generateSideWallUV(Y, ay, ax, t, s);
        Y.faceVertexUvs[0].push([i[0], i[1], i[3]]);
        Y.faceVertexUvs[0].push([i[1], i[2], i[3]])
    }
};
THREE.ExtrudeGeometry.WorldUVGenerator = {
    generateTopUV: function(j, i, h, g) {
        var f = j.vertices;
        var e = f[i];
        var d = f[h];
        var k = f[g];
        return [new THREE.Vector2(e.x, e.y), new THREE.Vector2(d.x, d.y), new THREE.Vector2(k.x, k.y)]
    },
    generateSideWallUV: function(h, n, m, l, k) {
        var e = h.vertices;
        var j = e[n];
        var i = e[m];
        var g = e[l];
        var f = e[k];
        if (Math.abs(j.y - i.y) < 0.01) {
            return [new THREE.Vector2(j.x, 1 - j.z), new THREE.Vector2(i.x, 1 - i.z), new THREE.Vector2(g.x, 1 - g.z), new THREE.Vector2(f.x, 1 - f.z)]
        } else {
            return [new THREE.Vector2(j.y, 1 - j.z), new THREE.Vector2(i.y, 1 - i.z), new THREE.Vector2(g.y, 1 - g.z), new THREE.Vector2(f.y, 1 - f.z)]
        }
    }
};
THREE.ShapeGeometry = function(a, b) {
    THREE.Geometry.call(this);
    this.type = "ShapeGeometry";
    if (a instanceof Array === false) {
        a = [a]
    }
    this.addShapeList(a, b);
    this.computeFaceNormals()
};
THREE.ShapeGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.ShapeGeometry.prototype.constructor = THREE.ShapeGeometry;
THREE.ShapeGeometry.prototype.addShapeList = function(b, c) {
    for (var d = 0, a = b.length; d < a; d++) {
        this.addShape(b[d], c)
    }
    return this
};
THREE.ShapeGeometry.prototype.addShape = function(e, h) {
    if (h === undefined) {
        h = {}
    }
    var d = h.curveSegments !== undefined ? h.curveSegments : 12;
    var q = h.material;
    var C = h.UVGenerator === undefined ? THREE.ExtrudeGeometry.WorldUVGenerator : h.UVGenerator;
    var B, A, r, u;
    var p = this.vertices.length;
    var E = e.extractPoints(d);
    var j = E.shape;
    var m = E.holes;
    var o = !THREE.Shape.Utils.isClockWise(j);
    if (o) {
        j = j.reverse();
        for (B = 0, A = m.length; B < A; B++) {
            r = m[B];
            if (THREE.Shape.Utils.isClockWise(r)) {
                m[B] = r.reverse()
            }
        }
        o = false
    }
    var f = THREE.Shape.Utils.triangulateShape(j, m);
    var v = j;
    for (B = 0, A = m.length; B < A; B++) {
        r = m[B];
        j = j.concat(r)
    }
    var D, k = j.length;
    var n, I = f.length;
    var g, t = v.length;
    for (B = 0; B < k; B++) {
        D = j[B];
        this.vertices.push(new THREE.Vector3(D.x, D.y, 0))
    }
    for (B = 0; B < I; B++) {
        n = f[B];
        var H = n[0] + p;
        var G = n[1] + p;
        var F = n[2] + p;
        this.faces.push(new THREE.Face3(H, G, F, null, null, q));
        this.faceVertexUvs[0].push(C.generateTopUV(this, H, G, F))
    }
};
THREE.LatheGeometry = function(t, q, n, p) {
    THREE.Geometry.call(this);
    this.type = "LatheGeometry";
    this.parameters = {
        points: t,
        segments: q,
        phiStart: n,
        phiLength: p
    };
    q = q || 12;
    n = n || 0;
    p = p || 2 * Math.PI;
    var E = 1 / (t.length - 1);
    var D = 1 / q;
    for (var u = 0, l = q; u <= l; u++) {
        var g = n + u * D * p;
        var G = Math.cos(g),
            m = Math.sin(g);
        for (var r = 0, A = t.length; r < A; r++) {
            var o = t[r];
            var C = new THREE.Vector3();
            C.x = G * o.x - m * o.y;
            C.y = m * o.x + G * o.y;
            C.z = o.z;
            this.vertices.push(C)
        }
    }
    var e = t.length;
    for (var u = 0, l = q; u < l; u++) {
        for (var r = 0, A = t.length - 1; r < A; r++) {
            var k = r + e * u;
            var I = k;
            var H = k + e;
            var G = k + 1 + e;
            var F = k + 1;
            var B = u * D;
            var h = r * E;
            var v = B + D;
            var f = h + E;
            this.faces.push(new THREE.Face3(I, H, F));
            this.faceVertexUvs[0].push([new THREE.Vector2(B, h), new THREE.Vector2(v, h), new THREE.Vector2(B, f)]);
            this.faces.push(new THREE.Face3(H, G, F));
            this.faceVertexUvs[0].push([new THREE.Vector2(v, h), new THREE.Vector2(v, f), new THREE.Vector2(B, f)])
        }
    }
    this.mergeVertices();
    this.computeFaceNormals();
    this.computeVertexNormals()
};
THREE.LatheGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.LatheGeometry.prototype.constructor = THREE.LatheGeometry;
THREE.PlaneGeometry = function(b, a, d, c) {
    console.info("THREE.PlaneGeometry: Consider using THREE.PlaneBufferGeometry for lower memory footprint.");
    THREE.Geometry.call(this);
    this.type = "PlaneGeometry";
    this.parameters = {
        width: b,
        height: a,
        widthSegments: d,
        heightSegments: c
    };
    this.fromBufferGeometry(new THREE.PlaneBufferGeometry(b, a, d, c))
};
THREE.PlaneGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.PlaneGeometry.prototype.constructor = THREE.PlaneGeometry;
THREE.PlaneBufferGeometry = function(t, r, f, q) {
    THREE.BufferGeometry.call(this);
    this.type = "PlaneBufferGeometry";
    this.parameters = {
        width: t,
        height: r,
        widthSegments: f,
        heightSegments: q
    };
    var j = t / 2;
    var h = r / 2;
    var A = f || 1;
    var v = q || 1;
    var B = A + 1;
    var e = v + 1;
    var H = t / A;
    var D = r / v;
    var m = new Float32Array(B * e * 3);
    var s = new Float32Array(B * e * 3);
    var p = new Float32Array(B * e * 2);
    var l = 0;
    var u = 0;
    for (var g = 0; g < e; g++) {
        var n = g * D - h;
        for (var i = 0; i < B; i++) {
            var o = i * H - j;
            m[l] = o;
            m[l + 1] = -n;
            s[l + 2] = 1;
            p[u] = i / A;
            p[u + 1] = 1 - (g / v);
            l += 3;
            u += 2
        }
    }
    l = 0;
    var k = new((m.length / 3) > 65535 ? Uint32Array : Uint16Array)(A * v * 6);
    for (var g = 0; g < v; g++) {
        for (var i = 0; i < A; i++) {
            var G = i + B * g;
            var F = i + B * (g + 1);
            var E = (i + 1) + B * (g + 1);
            var C = (i + 1) + B * g;
            k[l] = G;
            k[l + 1] = F;
            k[l + 2] = C;
            k[l + 3] = F;
            k[l + 4] = E;
            k[l + 5] = C;
            l += 6
        }
    }
    this.addAttribute("index", new THREE.BufferAttribute(k, 1));
    this.addAttribute("position", new THREE.BufferAttribute(m, 3));
    this.addAttribute("normal", new THREE.BufferAttribute(s, 3));
    this.addAttribute("uv", new THREE.BufferAttribute(p, 2))
};
THREE.PlaneBufferGeometry.prototype = Object.create(THREE.BufferGeometry.prototype);
THREE.PlaneBufferGeometry.prototype.constructor = THREE.PlaneBufferGeometry;
THREE.RingGeometry = function(k, r, g, s, h, p) {
    THREE.Geometry.call(this);
    this.type = "RingGeometry";
    this.parameters = {
        innerRadius: k,
        outerRadius: r,
        thetaSegments: g,
        phiSegments: s,
        thetaStart: h,
        thetaLength: p
    };
    k = k || 0;
    r = r || 50;
    h = h !== undefined ? h : 0;
    p = p !== undefined ? p : Math.PI * 2;
    g = g !== undefined ? Math.max(3, g) : 8;
    s = s !== undefined ? Math.max(1, s) : 8;
    var t, m, l = [],
        f = k,
        j = ((r - k) / s);
    for (t = 0; t < s + 1; t++) {
        for (m = 0; m < g + 1; m++) {
            var u = new THREE.Vector3();
            var c = h + m / g * p;
            u.x = f * Math.cos(c);
            u.y = f * Math.sin(c);
            this.vertices.push(u);
            l.push(new THREE.Vector2((u.x / r + 1) / 2, (u.y / r + 1) / 2))
        }
        f += j
    }
    var q = new THREE.Vector3(0, 0, 1);
    for (t = 0; t < s; t++) {
        var a = t * (g + 1);
        for (m = 0; m < g; m++) {
            var c = m + a;
            var e = c;
            var d = c + g + 1;
            var b = c + g + 2;
            this.faces.push(new THREE.Face3(e, d, b, [q.clone(), q.clone(), q.clone()]));
            this.faceVertexUvs[0].push([l[e].clone(), l[d].clone(), l[b].clone()]);
            e = c;
            d = c + g + 2;
            b = c + 1;
            this.faces.push(new THREE.Face3(e, d, b, [q.clone(), q.clone(), q.clone()]));
            this.faceVertexUvs[0].push([l[e].clone(), l[d].clone(), l[b].clone()])
        }
    }
    this.computeFaceNormals();
    this.boundingSphere = new THREE.Sphere(new THREE.Vector3(), f)
};
THREE.RingGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.RingGeometry.prototype.constructor = THREE.RingGeometry;
THREE.SphereGeometry = function(f, e, r, t, B, g, A) {
    THREE.Geometry.call(this);
    this.type = "SphereGeometry";
    this.parameters = {
        radius: f,
        widthSegments: e,
        heightSegments: r,
        phiStart: t,
        phiLength: B,
        thetaStart: g,
        thetaLength: A
    };
    f = f || 50;
    e = Math.max(3, Math.floor(e) || 8);
    r = Math.max(2, Math.floor(r) || 6);
    t = t !== undefined ? t : 0;
    B = B !== undefined ? B : Math.PI * 2;
    g = g !== undefined ? g : 0;
    A = A !== undefined ? A : Math.PI;
    var n, m, h = [],
        o = [];
    for (m = 0; m <= r; m++) {
        var s = [];
        var H = [];
        for (n = 0; n <= e; n++) {
            var q = n / e;
            var p = m / r;
            var E = new THREE.Vector3();
            E.x = -f * Math.cos(t + q * B) * Math.sin(g + p * A);
            E.y = f * Math.cos(g + p * A);
            E.z = f * Math.sin(t + q * B) * Math.sin(g + p * A);
            this.vertices.push(E);
            s.push(this.vertices.length - 1);
            H.push(new THREE.Vector2(q, 1 - p))
        }
        h.push(s);
        o.push(H)
    }
    for (m = 0; m < r; m++) {
        for (n = 0; n < e; n++) {
            var d = h[m][n + 1];
            var c = h[m][n];
            var b = h[m + 1][n];
            var a = h[m + 1][n + 1];
            var l = this.vertices[d].clone().normalize();
            var k = this.vertices[c].clone().normalize();
            var j = this.vertices[b].clone().normalize();
            var i = this.vertices[a].clone().normalize();
            var G = o[m][n + 1].clone();
            var F = o[m][n].clone();
            var D = o[m + 1][n].clone();
            var C = o[m + 1][n + 1].clone();
            if (Math.abs(this.vertices[d].y) === f) {
                G.x = (G.x + F.x) / 2;
                this.faces.push(new THREE.Face3(d, b, a, [l, j, i]));
                this.faceVertexUvs[0].push([G, D, C])
            } else {
                if (Math.abs(this.vertices[b].y) === f) {
                    D.x = (D.x + C.x) / 2;
                    this.faces.push(new THREE.Face3(d, c, b, [l, k, j]));
                    this.faceVertexUvs[0].push([G, F, D])
                } else {
                    this.faces.push(new THREE.Face3(d, c, a, [l, k, i]));
                    this.faceVertexUvs[0].push([G, F, C]);
                    this.faces.push(new THREE.Face3(c, b, a, [k.clone(), j, i.clone()]));
                    this.faceVertexUvs[0].push([F.clone(), D, C.clone()])
                }
            }
        }
    }
    this.computeFaceNormals();
    this.boundingSphere = new THREE.Sphere(new THREE.Vector3(), f)
};
THREE.SphereGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.SphereGeometry.prototype.constructor = THREE.SphereGeometry;
THREE.TextGeometry = function(b, a) {
    a = a || {};
    var c = THREE.FontUtils.generateShapes(b, a);
    a.amount = a.height !== undefined ? a.height : 50;
    if (a.bevelThickness === undefined) {
        a.bevelThickness = 10
    }
    if (a.bevelSize === undefined) {
        a.bevelSize = 8
    }
    if (a.bevelEnabled === undefined) {
        a.bevelEnabled = false
    }
    THREE.ExtrudeGeometry.call(this, c, a);
    this.type = "TextGeometry"
};
THREE.TextGeometry.prototype = Object.create(THREE.ExtrudeGeometry.prototype);
THREE.TextGeometry.prototype.constructor = THREE.TextGeometry;
THREE.TorusGeometry = function(g, f, e, l, h) {
    THREE.Geometry.call(this);
    this.type = "TorusGeometry";
    this.parameters = {
        radius: g,
        tube: f,
        radialSegments: e,
        tubularSegments: l,
        arc: h
    };
    g = g || 100;
    f = f || 40;
    e = e || 8;
    l = l || 6;
    h = h || Math.PI * 2;
    var C = new THREE.Vector3(),
        m = [],
        p = [];
    for (var q = 0; q <= e; q++) {
        for (var r = 0; r <= l; r++) {
            var o = r / l * h;
            var n = q / e * Math.PI * 2;
            C.x = g * Math.cos(o);
            C.y = g * Math.sin(o);
            var s = new THREE.Vector3();
            s.x = (g + f * Math.cos(n)) * Math.cos(o);
            s.y = (g + f * Math.cos(n)) * Math.sin(o);
            s.z = f * Math.sin(n);
            this.vertices.push(s);
            m.push(new THREE.Vector2(r / l, q / e));
            p.push(s.clone().sub(C).normalize())
        }
    }
    for (var q = 1; q <= e; q++) {
        for (var r = 1; r <= l; r++) {
            var D = (l + 1) * q + r - 1;
            var B = (l + 1) * (q - 1) + r - 1;
            var A = (l + 1) * (q - 1) + r;
            var t = (l + 1) * q + r;
            var k = new THREE.Face3(D, B, t, [p[D].clone(), p[B].clone(), p[t].clone()]);
            this.faces.push(k);
            this.faceVertexUvs[0].push([m[D].clone(), m[B].clone(), m[t].clone()]);
            k = new THREE.Face3(B, A, t, [p[B].clone(), p[A].clone(), p[t].clone()]);
            this.faces.push(k);
            this.faceVertexUvs[0].push([m[B].clone(), m[A].clone(), m[t].clone()])
        }
    }
    this.computeFaceNormals()
};
THREE.TorusGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.TorusGeometry.prototype.constructor = THREE.TorusGeometry;
THREE.TorusKnotGeometry = function(s, r, m, B, F, E, f) {
    THREE.Geometry.call(this);
    this.type = "TorusKnotGeometry";
    this.parameters = {
        radius: s,
        tube: r,
        radialSegments: m,
        tubularSegments: B,
        p: F,
        q: E,
        heightScale: f
    };
    s = s || 100;
    r = r || 40;
    m = m || 64;
    B = B || 8;
    F = F || 2;
    E = E || 3;
    f = f || 1;
    var e = new Array(m);
    var o = new THREE.Vector3();
    var G = new THREE.Vector3();
    var T = new THREE.Vector3();
    for (var K = 0; K < m; ++K) {
        e[K] = new Array(B);
        var D = K / m * 2 * F * Math.PI;
        var h = L(D, E, F, s, f);
        var g = L(D + 0.01, E, F, s, f);
        o.subVectors(g, h);
        G.addVectors(g, h);
        T.crossVectors(o, G);
        G.crossVectors(T, o);
        T.normalize();
        G.normalize();
        for (var I = 0; I < B; ++I) {
            var C = I / B * 2 * Math.PI;
            var l = -r * Math.cos(C);
            var k = r * Math.sin(C);
            var t = new THREE.Vector3();
            t.x = h.x + l * G.x + k * T.x;
            t.y = h.y + l * G.y + k * T.y;
            t.z = h.z + l * G.z + k * T.z;
            e[K][I] = this.vertices.push(t) - 1
        }
    }
    for (var K = 0; K < m; ++K) {
        for (var I = 0; I < B; ++I) {
            var A = (K + 1) % m;
            var H = (I + 1) % B;
            var S = e[K][I];
            var R = e[A][I];
            var Q = e[A][H];
            var P = e[K][H];
            var O = new THREE.Vector2(K / m, I / B);
            var N = new THREE.Vector2((K + 1) / m, I / B);
            var M = new THREE.Vector2((K + 1) / m, (I + 1) / B);
            var J = new THREE.Vector2(K / m, (I + 1) / B);
            this.faces.push(new THREE.Face3(S, R, P));
            this.faceVertexUvs[0].push([O, N, J]);
            this.faces.push(new THREE.Face3(R, Q, P));
            this.faceVertexUvs[0].push([N.clone(), M, J.clone()])
        }
    }
    this.computeFaceNormals();
    this.computeVertexNormals();

    function L(U, p, v, q, a) {
        var j = Math.cos(U);
        var V = Math.sin(U);
        var i = p / v * U;
        var n = Math.cos(i);
        var d = q * (2 + n) * 0.5 * j;
        var c = q * (2 + n) * V * 0.5;
        var b = a * q * Math.sin(i) * 0.5;
        return new THREE.Vector3(d, c, b)
    }
};
THREE.TorusKnotGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.TorusKnotGeometry.prototype.constructor = THREE.TorusKnotGeometry;
THREE.TubeGeometry = function(N, h, M, H, L, Y) {
    THREE.Geometry.call(this);
    this.type = "TubeGeometry";
    this.parameters = {
        path: N,
        segments: h,
        radius: M,
        radialSegments: H,
        closed: L
    };
    h = h || 64;
    M = M || 1;
    H = H || 8;
    L = L || false;
    Y = Y || THREE.TubeGeometry.NoTaper;
    var J = [];
    var A = this,
        E, K, B, e = h + 1,
        F, D, C, R, Q, P, I, G, O, o, n, t, f = new THREE.Vector3(),
        U, S, s, g, ac, ab, aa, Z, X, W, V, T;
    var p = new THREE.TubeGeometry.FrenetFrames(N, h, L),
        q = p.tangents,
        m = p.normals,
        l = p.binormals;
    this.tangents = q;
    this.normals = m;
    this.binormals = l;

    function k(a, c, b) {
        return A.vertices.push(new THREE.Vector3(a, c, b)) - 1
    }
    for (U = 0; U < e; U++) {
        J[U] = [];
        I = U / (e - 1);
        t = N.getPointAt(I);
        E = q[U];
        K = m[U];
        B = l[U];
        O = M * Y(I);
        for (S = 0; S < H; S++) {
            G = S / H * 2 * Math.PI;
            o = -O * Math.cos(G);
            n = O * Math.sin(G);
            f.copy(t);
            f.x += o * K.x + n * B.x;
            f.y += o * K.y + n * B.y;
            f.z += o * K.z + n * B.z;
            J[U][S] = k(f.x, f.y, f.z)
        }
    }
    for (U = 0; U < h; U++) {
        for (S = 0; S < H; S++) {
            s = (L) ? (U + 1) % h : U + 1;
            g = (S + 1) % H;
            ac = J[U][S];
            ab = J[s][S];
            aa = J[s][g];
            Z = J[U][g];
            X = new THREE.Vector2(U / h, S / H);
            W = new THREE.Vector2((U + 1) / h, S / H);
            V = new THREE.Vector2((U + 1) / h, (S + 1) / H);
            T = new THREE.Vector2(U / h, (S + 1) / H);
            this.faces.push(new THREE.Face3(ac, ab, Z));
            this.faceVertexUvs[0].push([X, W, T]);
            this.faces.push(new THREE.Face3(ab, aa, Z));
            this.faceVertexUvs[0].push([W.clone(), V, T.clone()])
        }
    }
    this.computeFaceNormals();
    this.computeVertexNormals()
};
THREE.TubeGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.TubeGeometry.prototype.constructor = THREE.TubeGeometry;
THREE.TubeGeometry.NoTaper = function(a) {
    return 1
};
THREE.TubeGeometry.SinusoidalTaper = function(a) {
    return Math.sin(Math.PI * a)
};
THREE.TubeGeometry.FrenetFrames = function(m, p, c) {
    var f = new THREE.Vector3(),
        B = new THREE.Vector3(),
        n = new THREE.Vector3(),
        o = [],
        l = [],
        d = [],
        k = new THREE.Vector3(),
        r = new THREE.Matrix4(),
        b = p + 1,
        e, C = 0.0001,
        a, A, t, s, q, j, g;
    this.tangents = o;
    this.normals = l;
    this.binormals = d;
    for (q = 0; q < b; q++) {
        j = q / (b - 1);
        o[q] = m.getTangentAt(j);
        o[q].normalize()
    }
    h();

    function h() {
        l[0] = new THREE.Vector3();
        d[0] = new THREE.Vector3();
        a = Number.MAX_VALUE;
        A = Math.abs(o[0].x);
        t = Math.abs(o[0].y);
        s = Math.abs(o[0].z);
        if (A <= a) {
            a = A;
            B.set(1, 0, 0)
        }
        if (t <= a) {
            a = t;
            B.set(0, 1, 0)
        }
        if (s <= a) {
            B.set(0, 0, 1)
        }
        k.crossVectors(o[0], B).normalize();
        l[0].crossVectors(o[0], k);
        d[0].crossVectors(o[0], l[0])
    }
    for (q = 1; q < b; q++) {
        l[q] = l[q - 1].clone();
        d[q] = d[q - 1].clone();
        k.crossVectors(o[q - 1], o[q]);
        if (k.length() > C) {
            k.normalize();
            e = Math.acos(THREE.Math.clamp(o[q - 1].dot(o[q]), -1, 1));
            l[q].applyMatrix4(r.makeRotationAxis(k, e))
        }
        d[q].crossVectors(o[q], l[q])
    }
    if (c) {
        e = Math.acos(THREE.Math.clamp(l[0].dot(l[b - 1]), -1, 1));
        e /= (b - 1);
        if (o[0].dot(k.crossVectors(l[0], l[b - 1])) > 0) {
            e = -e
        }
        for (q = 1; q < b; q++) {
            l[q].applyMatrix4(r.makeRotationAxis(o[q], e * q));
            d[q].crossVectors(o[q], l[q])
        }
    }
};
THREE.PolyhedronGeometry = function(n, m, k, I) {
    THREE.Geometry.call(this);
    this.type = "PolyhedronGeometry";
    this.parameters = {
        vertices: n,
        indices: m,
        radius: k,
        detail: I
    };
    k = k || 1;
    I = I || 0;
    var o = this;
    for (var D = 0, A = n.length; D < A; D += 3) {
        e(new THREE.Vector3(n[D], n[D + 1], n[D + 2]))
    }
    var u = [],
        t = this.vertices;
    var c = [];
    for (var D = 0, B = 0, A = m.length; D < A; D += 3, B++) {
        var g = t[m[D]];
        var f = t[m[D + 1]];
        var b = t[m[D + 2]];
        c[B] = new THREE.Face3(g.index, f.index, b.index, [g.clone(), f.clone(), b.clone()])
    }
    var s = new THREE.Vector3();
    for (var D = 0, A = c.length; D < A; D++) {
        q(c[D], I)
    }
    for (var D = 0, A = this.faceVertexUvs[0].length; D < A; D++) {
        var r = this.faceVertexUvs[0][D];
        var H = r[0].x;
        var G = r[1].x;
        var F = r[2].x;
        var C = Math.max(H, Math.max(G, F));
        var v = Math.min(H, Math.min(G, F));
        if (C > 0.9 && v < 0.1) {
            if (H < 0.2) {
                r[0].x += 1
            }
            if (G < 0.2) {
                r[1].x += 1
            }
            if (F < 0.2) {
                r[2].x += 1
            }
        }
    }
    for (var D = 0, A = this.vertices.length; D < A; D++) {
        this.vertices[D].multiplyScalar(k)
    }
    this.mergeVertices();
    this.computeFaceNormals();
    this.boundingSphere = new THREE.Sphere(new THREE.Vector3(), k);

    function e(i) {
        var p = i.normalize().clone();
        p.index = o.vertices.push(p) - 1;
        var l = E(i) / 2 / Math.PI + 0.5;
        var j = d(i) / Math.PI + 0.5;
        p.uv = new THREE.Vector2(l, 1 - j);
        return p
    }

    function h(J, p, l) {
        var j = new THREE.Face3(J.index, p.index, l.index, [J.clone(), p.clone(), l.clone()]);
        o.faces.push(j);
        s.copy(J).add(p).add(l).divideScalar(3);
        var i = E(s);
        o.faceVertexUvs[0].push([a(J.uv, J, i), a(p.uv, p, i), a(l.uv, l, i)])
    }

    function q(N, L) {
        var P = Math.pow(2, L);
        var T = Math.pow(4, L);
        var R = e(o.vertices[N.a]);
        var Q = e(o.vertices[N.b]);
        var O = e(o.vertices[N.c]);
        var S = [];
        for (var K = 0; K <= P; K++) {
            S[K] = [];
            var M = e(R.clone().lerp(O, K / P));
            var l = e(Q.clone().lerp(O, K / P));
            var U = P - K;
            for (var J = 0; J <= U; J++) {
                if (J == 0 && K == P) {
                    S[K][J] = M
                } else {
                    S[K][J] = e(M.clone().lerp(l, J / U))
                }
            }
        }
        for (var K = 0; K < P; K++) {
            for (var J = 0; J < 2 * (P - K) - 1; J++) {
                var p = Math.floor(J / 2);
                if (J % 2 == 0) {
                    h(S[K][p + 1], S[K + 1][p], S[K][p])
                } else {
                    h(S[K][p + 1], S[K + 1][p + 1], S[K + 1][p])
                }
            }
        }
    }

    function E(i) {
        return Math.atan2(i.z, -i.x)
    }

    function d(i) {
        return Math.atan2(-i.y, Math.sqrt((i.x * i.x) + (i.z * i.z)))
    }

    function a(j, i, l) {
        if ((l < 0) && (j.x === 1)) {
            j = new THREE.Vector2(j.x - 1, j.y)
        }
        if ((i.x === 0) && (i.z === 0)) {
            j = new THREE.Vector2(l / 2 / Math.PI + 0.5, j.y)
        }
        return j.clone()
    }
};
THREE.PolyhedronGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.PolyhedronGeometry.prototype.constructor = THREE.PolyhedronGeometry;
THREE.DodecahedronGeometry = function(a, d) {
    this.parameters = {
        radius: a,
        detail: d
    };
    var c = (1 + Math.sqrt(5)) / 2;
    var e = 1 / c;
    var b = [-1, -1, -1, -1, -1, 1, -1, 1, -1, -1, 1, 1, 1, -1, -1, 1, -1, 1, 1, 1, -1, 1, 1, 1, 0, -e, -c, 0, -e, c, 0, e, -c, 0, e, c, -e, -c, 0, -e, c, 0, e, -c, 0, e, c, 0, -c, 0, -e, c, 0, -e, -c, 0, e, c, 0, e];
    var f = [3, 11, 7, 3, 7, 15, 3, 15, 13, 7, 19, 17, 7, 17, 6, 7, 6, 15, 17, 4, 8, 17, 8, 10, 17, 10, 6, 8, 0, 16, 8, 16, 2, 8, 2, 10, 0, 12, 1, 0, 1, 18, 0, 18, 16, 6, 10, 2, 6, 2, 13, 6, 13, 15, 2, 16, 18, 2, 18, 3, 2, 3, 13, 18, 1, 9, 18, 9, 11, 18, 11, 3, 4, 14, 12, 4, 12, 0, 4, 0, 8, 11, 9, 5, 11, 5, 19, 11, 19, 7, 19, 5, 14, 19, 14, 4, 19, 4, 17, 1, 12, 14, 1, 14, 5, 1, 5, 9];
    THREE.PolyhedronGeometry.call(this, b, f, a, d)
};
THREE.DodecahedronGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.DodecahedronGeometry.prototype.constructor = THREE.DodecahedronGeometry;
THREE.IcosahedronGeometry = function(a, d) {
    var c = (1 + Math.sqrt(5)) / 2;
    var b = [-1, c, 0, 1, c, 0, -1, -c, 0, 1, -c, 0, 0, -1, c, 0, 1, c, 0, -1, -c, 0, 1, -c, c, 0, -1, c, 0, 1, -c, 0, -1, -c, 0, 1];
    var e = [0, 11, 5, 0, 5, 1, 0, 1, 7, 0, 7, 10, 0, 10, 11, 1, 5, 9, 5, 11, 4, 11, 10, 2, 10, 7, 6, 7, 1, 8, 3, 9, 4, 3, 4, 2, 3, 2, 6, 3, 6, 8, 3, 8, 9, 4, 9, 5, 2, 4, 11, 6, 2, 10, 8, 6, 7, 9, 8, 1];
    THREE.PolyhedronGeometry.call(this, b, e, a, d);
    this.type = "IcosahedronGeometry";
    this.parameters = {
        radius: a,
        detail: d
    }
};
THREE.IcosahedronGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.IcosahedronGeometry.prototype.constructor = THREE.IcosahedronGeometry;
THREE.OctahedronGeometry = function(a, c) {
    this.parameters = {
        radius: a,
        detail: c
    };
    var b = [1, 0, 0, -1, 0, 0, 0, 1, 0, 0, -1, 0, 0, 0, 1, 0, 0, -1];
    var d = [0, 2, 4, 0, 4, 3, 0, 3, 5, 0, 5, 2, 1, 2, 5, 1, 5, 3, 1, 3, 4, 1, 4, 2];
    THREE.PolyhedronGeometry.call(this, b, d, a, c);
    this.type = "OctahedronGeometry";
    this.parameters = {
        radius: a,
        detail: c
    }
};
THREE.OctahedronGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.OctahedronGeometry.prototype.constructor = THREE.OctahedronGeometry;
THREE.TetrahedronGeometry = function(a, c) {
    var b = [1, 1, 1, -1, -1, 1, -1, 1, -1, 1, -1, -1];
    var d = [2, 1, 0, 0, 3, 2, 1, 3, 0, 2, 3, 1];
    THREE.PolyhedronGeometry.call(this, b, d, a, c);
    this.type = "TetrahedronGeometry";
    this.parameters = {
        radius: a,
        detail: c
    }
};
THREE.TetrahedronGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.TetrahedronGeometry.prototype.constructor = THREE.TetrahedronGeometry;
THREE.ParametricGeometry = function(g, f, E) {
    THREE.Geometry.call(this);
    this.type = "ParametricGeometry";
    this.parameters = {
        func: g,
        slices: f,
        stacks: E
    };
    var I = this.vertices;
    var e = this.faces;
    var k = this.faceVertexUvs[0];
    var s, h, q, o;
    var m, l;
    var n = E + 1;
    var H = f + 1;
    for (s = 0; s <= E; s++) {
        l = s / E;
        for (q = 0; q <= f; q++) {
            m = q / f;
            o = g(m, l);
            I.push(o)
        }
    }
    var G, F, D, C;
    var B, A, t, r;
    for (s = 0; s < E; s++) {
        for (q = 0; q < f; q++) {
            G = s * H + q;
            F = s * H + q + 1;
            D = (s + 1) * H + q + 1;
            C = (s + 1) * H + q;
            B = new THREE.Vector2(q / f, s / E);
            A = new THREE.Vector2((q + 1) / f, s / E);
            t = new THREE.Vector2((q + 1) / f, (s + 1) / E);
            r = new THREE.Vector2(q / f, (s + 1) / E);
            e.push(new THREE.Face3(G, F, C));
            k.push([B, A, r]);
            e.push(new THREE.Face3(F, D, C));
            k.push([A.clone(), t, r.clone()])
        }
    }
    this.computeFaceNormals();
    this.computeVertexNormals()
};
THREE.ParametricGeometry.prototype = Object.create(THREE.Geometry.prototype);
THREE.ParametricGeometry.prototype.constructor = THREE.ParametricGeometry;
THREE.AxisHelper = function(c) {
    c = c || 1;
    var b = new Float32Array([0, 0, 0, c, 0, 0, 0, 0, 0, 0, c, 0, 0, 0, 0, 0, 0, c]);
    var a = new Float32Array([1, 0, 0, 1, 0.6, 0, 0, 1, 0, 0.6, 1, 0, 0, 0, 1, 0, 0.6, 1]);
    var e = new THREE.BufferGeometry();
    e.addAttribute("position", new THREE.BufferAttribute(b, 3));
    e.addAttribute("color", new THREE.BufferAttribute(a, 3));
    var d = new THREE.LineBasicMaterial({
        vertexColors: THREE.VertexColors
    });
    THREE.Line.call(this, e, d, THREE.LinePieces)
};
THREE.AxisHelper.prototype = Object.create(THREE.Line.prototype);
THREE.AxisHelper.prototype.constructor = THREE.AxisHelper;
THREE.ArrowHelper = (function() {
    var a = new THREE.Geometry();
    a.vertices.push(new THREE.Vector3(0, 0, 0), new THREE.Vector3(0, 1, 0));
    var b = new THREE.CylinderGeometry(0, 0.5, 1, 5, 1);
    b.applyMatrix(new THREE.Matrix4().makeTranslation(0, -0.5, 0));
    return function(g, f, h, e, d, c) {
        THREE.Object3D.call(this);
        if (e === undefined) {
            e = 16776960
        }
        if (h === undefined) {
            h = 1
        }
        if (d === undefined) {
            d = 0.2 * h
        }
        if (c === undefined) {
            c = 0.2 * d
        }
        this.position.copy(f);
        this.line = new THREE.Line(a, new THREE.LineBasicMaterial({
            color: e
        }));
        this.line.matrixAutoUpdate = false;
        this.add(this.line);
        this.cone = new THREE.Mesh(b, new THREE.MeshBasicMaterial({
            color: e
        }));
        this.cone.matrixAutoUpdate = false;
        this.add(this.cone);
        this.setDirection(g);
        this.setLength(h, d, c)
    }
}());
THREE.ArrowHelper.prototype = Object.create(THREE.Object3D.prototype);
THREE.ArrowHelper.prototype.constructor = THREE.ArrowHelper;
THREE.ArrowHelper.prototype.setDirection = (function() {
    var a = new THREE.Vector3();
    var b;
    return function(c) {
        if (c.y > 0.99999) {
            this.quaternion.set(0, 0, 0, 1)
        } else {
            if (c.y < -0.99999) {
                this.quaternion.set(1, 0, 0, 0)
            } else {
                a.set(c.z, 0, -c.x).normalize();
                b = Math.acos(c.y);
                this.quaternion.setFromAxisAngle(a, b)
            }
        }
    }
}());
THREE.ArrowHelper.prototype.setLength = function(c, b, a) {
    if (b === undefined) {
        b = 0.2 * c
    }
    if (a === undefined) {
        a = 0.2 * b
    }
    this.line.scale.set(1, c - b, 1);
    this.line.updateMatrix();
    this.cone.scale.set(a, b, a);
    this.cone.position.y = c;
    this.cone.updateMatrix()
};
THREE.ArrowHelper.prototype.setColor = function(a) {
    this.line.material.color.set(a);
    this.cone.material.color.set(a)
};
THREE.BoxHelper = function(a) {
    var b = new THREE.BufferGeometry();
    b.addAttribute("position", new THREE.BufferAttribute(new Float32Array(72), 3));
    THREE.Line.call(this, b, new THREE.LineBasicMaterial({
        color: 16776960
    }), THREE.LinePieces);
    if (a !== undefined) {
        this.update(a)
    }
};
THREE.BoxHelper.prototype = Object.create(THREE.Line.prototype);
THREE.BoxHelper.prototype.constructor = THREE.BoxHelper;
THREE.BoxHelper.prototype.update = function(c) {
    var e = c.geometry;
    if (e.boundingBox === null) {
        e.computeBoundingBox()
    }
    var d = e.boundingBox.min;
    var a = e.boundingBox.max;
    var b = this.geometry.attributes.position.array;
    b[0] = a.x;
    b[1] = a.y;
    b[2] = a.z;
    b[3] = d.x;
    b[4] = a.y;
    b[5] = a.z;
    b[6] = d.x;
    b[7] = a.y;
    b[8] = a.z;
    b[9] = d.x;
    b[10] = d.y;
    b[11] = a.z;
    b[12] = d.x;
    b[13] = d.y;
    b[14] = a.z;
    b[15] = a.x;
    b[16] = d.y;
    b[17] = a.z;
    b[18] = a.x;
    b[19] = d.y;
    b[20] = a.z;
    b[21] = a.x;
    b[22] = a.y;
    b[23] = a.z;
    b[24] = a.x;
    b[25] = a.y;
    b[26] = d.z;
    b[27] = d.x;
    b[28] = a.y;
    b[29] = d.z;
    b[30] = d.x;
    b[31] = a.y;
    b[32] = d.z;
    b[33] = d.x;
    b[34] = d.y;
    b[35] = d.z;
    b[36] = d.x;
    b[37] = d.y;
    b[38] = d.z;
    b[39] = a.x;
    b[40] = d.y;
    b[41] = d.z;
    b[42] = a.x;
    b[43] = d.y;
    b[44] = d.z;
    b[45] = a.x;
    b[46] = a.y;
    b[47] = d.z;
    b[48] = a.x;
    b[49] = a.y;
    b[50] = a.z;
    b[51] = a.x;
    b[52] = a.y;
    b[53] = d.z;
    b[54] = d.x;
    b[55] = a.y;
    b[56] = a.z;
    b[57] = d.x;
    b[58] = a.y;
    b[59] = d.z;
    b[60] = d.x;
    b[61] = d.y;
    b[62] = a.z;
    b[63] = d.x;
    b[64] = d.y;
    b[65] = d.z;
    b[66] = a.x;
    b[67] = d.y;
    b[68] = a.z;
    b[69] = a.x;
    b[70] = d.y;
    b[71] = d.z;
    this.geometry.attributes.position.needsUpdate = true;
    this.geometry.computeBoundingSphere();
    this.matrix = c.matrixWorld;
    this.matrixAutoUpdate = false
};
THREE.BoundingBoxHelper = function(b, c) {
    var a = (c !== undefined) ? c : 8947848;
    this.object = b;
    this.box = new THREE.Box3();
    THREE.Mesh.call(this, new THREE.BoxGeometry(1, 1, 1), new THREE.MeshBasicMaterial({
        color: a,
        wireframe: true
    }))
};
THREE.BoundingBoxHelper.prototype = Object.create(THREE.Mesh.prototype);
THREE.BoundingBoxHelper.prototype.constructor = THREE.BoundingBoxHelper;
THREE.BoundingBoxHelper.prototype.update = function() {
    this.box.setFromObject(this.object);
    this.box.size(this.scale);
    this.box.center(this.position)
};
THREE.CameraHelper = function(e) {
    var h = new THREE.Geometry();
    var f = new THREE.LineBasicMaterial({
        color: 16777215,
        vertexColors: THREE.FaceColors
    });
    var g = {};
    var d = 16755200;
    var k = 16711680;
    var b = 43775;
    var i = 16777215;
    var c = 3355443;
    j("n1", "n2", d);
    j("n2", "n4", d);
    j("n4", "n3", d);
    j("n3", "n1", d);
    j("f1", "f2", d);
    j("f2", "f4", d);
    j("f4", "f3", d);
    j("f3", "f1", d);
    j("n1", "f1", d);
    j("n2", "f2", d);
    j("n3", "f3", d);
    j("n4", "f4", d);
    j("p", "n1", k);
    j("p", "n2", k);
    j("p", "n3", k);
    j("p", "n4", k);
    j("u1", "u2", b);
    j("u2", "u3", b);
    j("u3", "u1", b);
    j("c", "t", i);
    j("p", "c", c);
    j("cn1", "cn2", c);
    j("cn3", "cn4", c);
    j("cf1", "cf2", c);
    j("cf3", "cf4", c);

    function j(m, l, n) {
        a(m, n);
        a(l, n)
    }

    function a(m, l) {
        h.vertices.push(new THREE.Vector3());
        h.colors.push(new THREE.Color(l));
        if (g[m] === undefined) {
            g[m] = []
        }
        g[m].push(h.vertices.length - 1)
    }
    THREE.Line.call(this, h, f, THREE.LinePieces);
    this.camera = e;
    this.matrix = e.matrixWorld;
    this.matrixAutoUpdate = false;
    this.pointMap = g;
    this.update()
};
THREE.CameraHelper.prototype = Object.create(THREE.Line.prototype);
THREE.CameraHelper.prototype.constructor = THREE.CameraHelper;
THREE.CameraHelper.prototype.update = function() {
    var e, b;
    var a = new THREE.Vector3();
    var d = new THREE.Camera();
    var c = function(g, f, m, l) {
        a.set(f, m, l).unproject(d);
        var k = b[g];
        if (k !== undefined) {
            for (var j = 0, h = k.length; j < h; j++) {
                e.vertices[k[j]].copy(a)
            }
        }
    };
    return function() {
        e = this.geometry;
        b = this.pointMap;
        var f = 1,
            g = 1;
        d.projectionMatrix.copy(this.camera.projectionMatrix);
        c("c", 0, 0, -1);
        c("t", 0, 0, 1);
        c("n1", -f, -g, -1);
        c("n2", f, -g, -1);
        c("n3", -f, g, -1);
        c("n4", f, g, -1);
        c("f1", -f, -g, 1);
        c("f2", f, -g, 1);
        c("f3", -f, g, 1);
        c("f4", f, g, 1);
        c("u1", f * 0.7, g * 1.1, -1);
        c("u2", -f * 0.7, g * 1.1, -1);
        c("u3", 0, g * 2, -1);
        c("cf1", -f, 0, 1);
        c("cf2", f, 0, 1);
        c("cf3", 0, -g, 1);
        c("cf4", 0, g, 1);
        c("cn1", -f, 0, -1);
        c("cn2", f, 0, -1);
        c("cn3", 0, -g, -1);
        c("cn4", 0, g, -1);
        e.verticesNeedUpdate = true
    }
}();
THREE.DirectionalLightHelper = function(a, b) {
    THREE.Object3D.call(this);
    this.light = a;
    this.light.updateMatrixWorld();
    this.matrix = a.matrixWorld;
    this.matrixAutoUpdate = false;
    b = b || 1;
    var d = new THREE.Geometry();
    d.vertices.push(new THREE.Vector3(-b, b, 0), new THREE.Vector3(b, b, 0), new THREE.Vector3(b, -b, 0), new THREE.Vector3(-b, -b, 0), new THREE.Vector3(-b, b, 0));
    var c = new THREE.LineBasicMaterial({
        fog: false
    });
    c.color.copy(this.light.color).multiplyScalar(this.light.intensity);
    this.lightPlane = new THREE.Line(d, c);
    this.add(this.lightPlane);
    d = new THREE.Geometry();
    d.vertices.push(new THREE.Vector3(), new THREE.Vector3());
    c = new THREE.LineBasicMaterial({
        fog: false
    });
    c.color.copy(this.light.color).multiplyScalar(this.light.intensity);
    this.targetLine = new THREE.Line(d, c);
    this.add(this.targetLine);
    this.update()
};
THREE.DirectionalLightHelper.prototype = Object.create(THREE.Object3D.prototype);
THREE.DirectionalLightHelper.prototype.constructor = THREE.DirectionalLightHelper;
THREE.DirectionalLightHelper.prototype.dispose = function() {
    this.lightPlane.geometry.dispose();
    this.lightPlane.material.dispose();
    this.targetLine.geometry.dispose();
    this.targetLine.material.dispose()
};
THREE.DirectionalLightHelper.prototype.update = function() {
    var c = new THREE.Vector3();
    var b = new THREE.Vector3();
    var a = new THREE.Vector3();
    return function() {
        c.setFromMatrixPosition(this.light.matrixWorld);
        b.setFromMatrixPosition(this.light.target.matrixWorld);
        a.subVectors(b, c);
        this.lightPlane.lookAt(a);
        this.lightPlane.material.color.copy(this.light.color).multiplyScalar(this.light.intensity);
        this.targetLine.geometry.vertices[1].copy(a);
        this.targetLine.geometry.verticesNeedUpdate = true;
        this.targetLine.material.color.copy(this.lightPlane.material.color)
    }
}();
THREE.EdgesHelper = function(B, k) {
    var r = (k !== undefined) ? k : 16777215;
    var e = [0, 0],
        a = {};
    var q = function(i, h) {
        return i - h
    };
    var o = ["a", "b", "c"];
    var d = new THREE.BufferGeometry();
    var n = B.geometry.clone();
    n.mergeVertices();
    n.computeFaceNormals();
    var f = n.vertices;
    var b = n.faces;
    var c = 0;
    for (var u = 0, p = b.length; u < p; u++) {
        var m = b[u];
        for (var s = 0; s < 3; s++) {
            e[0] = m[o[s]];
            e[1] = m[o[(s + 1) % 3]];
            e.sort(q);
            var C = e.toString();
            if (a[C] === undefined) {
                a[C] = {
                    vert1: e[0],
                    vert2: e[1],
                    face1: u,
                    face2: undefined
                };
                c++
            } else {
                a[C].face2 = u
            }
        }
    }
    var t = new Float32Array(c * 2 * 3);
    var g = 0;
    for (var C in a) {
        var v = a[C];
        if (v.face2 === undefined || b[v.face1].normal.dot(b[v.face2].normal) < 0.9999) {
            var A = f[v.vert1];
            t[g++] = A.x;
            t[g++] = A.y;
            t[g++] = A.z;
            A = f[v.vert2];
            t[g++] = A.x;
            t[g++] = A.y;
            t[g++] = A.z
        }
    }
    d.addAttribute("position", new THREE.BufferAttribute(t, 3));
    THREE.Line.call(this, d, new THREE.LineBasicMaterial({
        color: r
    }), THREE.LinePieces);
    this.matrix = B.matrixWorld;
    this.matrixAutoUpdate = false
};
THREE.EdgesHelper.prototype = Object.create(THREE.Line.prototype);
THREE.EdgesHelper.prototype.constructor = THREE.EdgesHelper;
THREE.FaceNormalsHelper = function(e, k, c, j) {
    this.object = e;
    this.size = (k !== undefined) ? k : 1;
    var f = (c !== undefined) ? c : 16776960;
    var a = (j !== undefined) ? j : 1;
    var h = new THREE.Geometry();
    var b = this.object.geometry.faces;
    for (var g = 0, d = b.length; g < d; g++) {
        h.vertices.push(new THREE.Vector3(), new THREE.Vector3())
    }
    THREE.Line.call(this, h, new THREE.LineBasicMaterial({
        color: f,
        linewidth: a
    }), THREE.LinePieces);
    this.matrixAutoUpdate = false;
    this.normalMatrix = new THREE.Matrix3();
    this.update()
};
THREE.FaceNormalsHelper.prototype = Object.create(THREE.Line.prototype);
THREE.FaceNormalsHelper.prototype.constructor = THREE.FaceNormalsHelper;
THREE.FaceNormalsHelper.prototype.update = function() {
    var g = this.geometry.vertices;
    var e = this.object;
    var j = e.geometry.vertices;
    var b = e.geometry.faces;
    var a = e.matrixWorld;
    e.updateMatrixWorld(true);
    this.normalMatrix.getNormalMatrix(a);
    for (var f = 0, c = 0, d = b.length; f < d; f++, c += 2) {
        var h = b[f];
        g[c].copy(j[h.a]).add(j[h.b]).add(j[h.c]).divideScalar(3).applyMatrix4(a);
        g[c + 1].copy(h.normal).applyMatrix3(this.normalMatrix).normalize().multiplyScalar(this.size).add(g[c])
    }
    this.geometry.verticesNeedUpdate = true;
    return this
};
THREE.GridHelper = function(c, e) {
    var f = new THREE.Geometry();
    var d = new THREE.LineBasicMaterial({
        vertexColors: THREE.VertexColors
    });
    this.color1 = new THREE.Color(4473924);
    this.color2 = new THREE.Color(8947848);
    for (var b = -c; b <= c; b += e) {
        f.vertices.push(new THREE.Vector3(-c, 0, b), new THREE.Vector3(c, 0, b), new THREE.Vector3(b, 0, -c), new THREE.Vector3(b, 0, c));
        var a = b === 0 ? this.color1 : this.color2;
        f.colors.push(a, a, a, a)
    }
    THREE.Line.call(this, f, d, THREE.LinePieces)
};
THREE.GridHelper.prototype = Object.create(THREE.Line.prototype);
THREE.GridHelper.prototype.constructor = THREE.GridHelper;
THREE.GridHelper.prototype.setColors = function(b, a) {
    this.color1.set(b);
    this.color2.set(a);
    this.geometry.colorsNeedUpdate = true
};
THREE.HemisphereLightHelper = function(a, h, g, e) {
    THREE.Object3D.call(this);
    this.light = a;
    this.light.updateMatrixWorld();
    this.matrix = a.matrixWorld;
    this.matrixAutoUpdate = false;
    this.colors = [new THREE.Color(), new THREE.Color()];
    var f = new THREE.SphereGeometry(h, 4, 2);
    f.applyMatrix(new THREE.Matrix4().makeRotationX(-Math.PI / 2));
    for (var c = 0, b = 8; c < b; c++) {
        f.faces[c].color = this.colors[c < 4 ? 0 : 1]
    }
    var d = new THREE.MeshBasicMaterial({
        vertexColors: THREE.FaceColors,
        wireframe: true
    });
    this.lightSphere = new THREE.Mesh(f, d);
    this.add(this.lightSphere);
    this.update()
};
THREE.HemisphereLightHelper.prototype = Object.create(THREE.Object3D.prototype);
THREE.HemisphereLightHelper.prototype.constructor = THREE.HemisphereLightHelper;
THREE.HemisphereLightHelper.prototype.dispose = function() {
    this.lightSphere.geometry.dispose();
    this.lightSphere.material.dispose()
};
THREE.HemisphereLightHelper.prototype.update = function() {
    var a = new THREE.Vector3();
    return function() {
        this.colors[0].copy(this.light.color).multiplyScalar(this.light.intensity);
        this.colors[1].copy(this.light.groundColor).multiplyScalar(this.light.intensity);
        this.lightSphere.lookAt(a.setFromMatrixPosition(this.light.matrixWorld).negate());
        this.lightSphere.geometry.colorsNeedUpdate = true
    }
}();
THREE.PointLightHelper = function(a, d) {
    this.light = a;
    this.light.updateMatrixWorld();
    var c = new THREE.SphereGeometry(d, 4, 2);
    var b = new THREE.MeshBasicMaterial({
        wireframe: true,
        fog: false
    });
    b.color.copy(this.light.color).multiplyScalar(this.light.intensity);
    THREE.Mesh.call(this, c, b);
    this.matrix = this.light.matrixWorld;
    this.matrixAutoUpdate = false
};
THREE.PointLightHelper.prototype = Object.create(THREE.Mesh.prototype);
THREE.PointLightHelper.prototype.constructor = THREE.PointLightHelper;
THREE.PointLightHelper.prototype.dispose = function() {
    this.geometry.dispose();
    this.material.dispose()
};
THREE.PointLightHelper.prototype.update = function() {
    this.material.color.copy(this.light.color).multiplyScalar(this.light.intensity)
};
THREE.SkeletonHelper = function(a) {
    this.bones = this.getBoneList(a);
    var e = new THREE.Geometry();
    for (var b = 0; b < this.bones.length; b++) {
        var d = this.bones[b];
        if (d.parent instanceof THREE.Bone) {
            e.vertices.push(new THREE.Vector3());
            e.vertices.push(new THREE.Vector3());
            e.colors.push(new THREE.Color(0, 0, 1));
            e.colors.push(new THREE.Color(0, 1, 0))
        }
    }
    var c = new THREE.LineBasicMaterial({
        vertexColors: THREE.VertexColors,
        depthTest: false,
        depthWrite: false,
        transparent: true
    });
    THREE.Line.call(this, e, c, THREE.LinePieces);
    this.root = a;
    this.matrix = a.matrixWorld;
    this.matrixAutoUpdate = false;
    this.update()
};
THREE.SkeletonHelper.prototype = Object.create(THREE.Line.prototype);
THREE.SkeletonHelper.prototype.constructor = THREE.SkeletonHelper;
THREE.SkeletonHelper.prototype.getBoneList = function(a) {
    var c = [];
    if (a instanceof THREE.Bone) {
        c.push(a)
    }
    for (var b = 0; b < a.children.length; b++) {
        c.push.apply(c, this.getBoneList(a.children[b]))
    }
    return c
};
THREE.SkeletonHelper.prototype.update = function() {
    var f = this.geometry;
    var e = new THREE.Matrix4().getInverse(this.root.matrixWorld);
    var c = new THREE.Matrix4();
    var a = 0;
    for (var b = 0; b < this.bones.length; b++) {
        var d = this.bones[b];
        if (d.parent instanceof THREE.Bone) {
            c.multiplyMatrices(e, d.matrixWorld);
            f.vertices[a].setFromMatrixPosition(c);
            c.multiplyMatrices(e, d.parent.matrixWorld);
            f.vertices[a + 1].setFromMatrixPosition(c);
            a += 2
        }
    }
    f.verticesNeedUpdate = true;
    f.computeBoundingSphere()
};
THREE.SpotLightHelper = function(a) {
    THREE.Object3D.call(this);
    this.light = a;
    this.light.updateMatrixWorld();
    this.matrix = a.matrixWorld;
    this.matrixAutoUpdate = false;
    var c = new THREE.CylinderGeometry(0, 1, 1, 8, 1, true);
    c.applyMatrix(new THREE.Matrix4().makeTranslation(0, -0.5, 0));
    c.applyMatrix(new THREE.Matrix4().makeRotationX(-Math.PI / 2));
    var b = new THREE.MeshBasicMaterial({
        wireframe: true,
        fog: false
    });
    this.cone = new THREE.Mesh(c, b);
    this.add(this.cone);
    this.update()
};
THREE.SpotLightHelper.prototype = Object.create(THREE.Object3D.prototype);
THREE.SpotLightHelper.prototype.constructor = THREE.SpotLightHelper;
THREE.SpotLightHelper.prototype.dispose = function() {
    this.cone.geometry.dispose();
    this.cone.material.dispose()
};
THREE.SpotLightHelper.prototype.update = function() {
    var a = new THREE.Vector3();
    var b = new THREE.Vector3();
    return function() {
        var c = this.light.distance ? this.light.distance : 10000;
        var d = c * Math.tan(this.light.angle);
        this.cone.scale.set(d, d, c);
        a.setFromMatrixPosition(this.light.matrixWorld);
        b.setFromMatrixPosition(this.light.target.matrixWorld);
        this.cone.lookAt(b.sub(a));
        this.cone.material.color.copy(this.light.color).multiplyScalar(this.light.intensity)
    }
}();
THREE.VertexNormalsHelper = function(e, q, c, p) {
    this.object = e;
    this.size = (q !== undefined) ? q : 1;
    var f = (c !== undefined) ? c : 16711680;
    var a = (p !== undefined) ? p : 1;
    var o = new THREE.Geometry();
    var m = e.geometry.vertices;
    var b = e.geometry.faces;
    for (var k = 0, d = b.length; k < d; k++) {
        var n = b[k];
        for (var g = 0, h = n.vertexNormals.length; g < h; g++) {
            o.vertices.push(new THREE.Vector3(), new THREE.Vector3())
        }
    }
    THREE.Line.call(this, o, new THREE.LineBasicMaterial({
        color: f,
        linewidth: a
    }), THREE.LinePieces);
    this.matrixAutoUpdate = false;
    this.normalMatrix = new THREE.Matrix3();
    this.update()
};
THREE.VertexNormalsHelper.prototype = Object.create(THREE.Line.prototype);
THREE.VertexNormalsHelper.prototype.constructor = THREE.VertexNormalsHelper;
THREE.VertexNormalsHelper.prototype.update = (function(a) {
    var b = new THREE.Vector3();
    return function(e) {
        var t = ["a", "b", "c", "d"];
        this.object.updateMatrixWorld(true);
        this.normalMatrix.getNormalMatrix(this.object.matrixWorld);
        var o = this.geometry.vertices;
        var r = this.object.geometry.vertices;
        var c = this.object.geometry.faces;
        var p = this.object.matrixWorld;
        var s = 0;
        for (var h = 0, d = c.length; h < d; h++) {
            var q = c[h];
            for (var f = 0, g = q.vertexNormals.length; f < g; f++) {
                var n = q[t[f]];
                var k = r[n];
                var m = q.vertexNormals[f];
                o[s].copy(k).applyMatrix4(p);
                b.copy(m).applyMatrix3(this.normalMatrix).normalize().multiplyScalar(this.size);
                b.add(o[s]);
                s = s + 1;
                o[s].copy(b);
                s = s + 1
            }
        }
        this.geometry.verticesNeedUpdate = true;
        return this
    }
}());
THREE.VertexTangentsHelper = function(e, q, c, p) {
    this.object = e;
    this.size = (q !== undefined) ? q : 1;
    var f = (c !== undefined) ? c : 255;
    var a = (p !== undefined) ? p : 1;
    var o = new THREE.Geometry();
    var m = e.geometry.vertices;
    var b = e.geometry.faces;
    for (var k = 0, d = b.length; k < d; k++) {
        var n = b[k];
        for (var g = 0, h = n.vertexTangents.length; g < h; g++) {
            o.vertices.push(new THREE.Vector3());
            o.vertices.push(new THREE.Vector3())
        }
    }
    THREE.Line.call(this, o, new THREE.LineBasicMaterial({
        color: f,
        linewidth: a
    }), THREE.LinePieces);
    this.matrixAutoUpdate = false;
    this.update()
};
THREE.VertexTangentsHelper.prototype = Object.create(THREE.Line.prototype);
THREE.VertexTangentsHelper.prototype.constructor = THREE.VertexTangentsHelper;
THREE.VertexTangentsHelper.prototype.update = (function(a) {
    var b = new THREE.Vector3();
    return function(e) {
        var t = ["a", "b", "c", "d"];
        this.object.updateMatrixWorld(true);
        var n = this.geometry.vertices;
        var q = this.object.geometry.vertices;
        var c = this.object.geometry.faces;
        var o = this.object.matrixWorld;
        var r = 0;
        for (var h = 0, d = c.length; h < d; h++) {
            var p = c[h];
            for (var f = 0, g = p.vertexTangents.length; f < g; f++) {
                var m = p[t[f]];
                var k = q[m];
                var s = p.vertexTangents[f];
                n[r].copy(k).applyMatrix4(o);
                b.copy(s).transformDirection(o).multiplyScalar(this.size);
                b.add(n[r]);
                r = r + 1;
                n[r].copy(b);
                r = r + 1
            }
        }
        this.geometry.verticesNeedUpdate = true;
        return this
    }
}());
THREE.WireframeHelper = function(K, r) {
    var F = (r !== undefined) ? r : 16777215;
    var k = [0, 0],
        a = {};
    var E = function(j, i) {
        return j - i
    };
    var B = ["a", "b", "c"];
    var f = new THREE.BufferGeometry();
    if (K.geometry instanceof THREE.Geometry) {
        var n = K.geometry.vertices;
        var b = K.geometry.faces;
        var c = 0;
        var d = new Uint32Array(6 * b.length);
        for (var I = 0, D = b.length; I < D; I++) {
            var t = b[I];
            for (var G = 0; G < 3; G++) {
                k[0] = t[B[G]];
                k[1] = t[B[(G + 1) % 3]];
                k.sort(E);
                var L = k.toString();
                if (a[L] === undefined) {
                    d[2 * c] = k[0];
                    d[2 * c + 1] = k[1];
                    a[L] = true;
                    c++
                }
            }
        }
        var H = new Float32Array(c * 2 * 3);
        for (var I = 0, D = c; I < D; I++) {
            for (var G = 0; G < 2; G++) {
                var J = n[d[2 * I + G]];
                var q = 6 * I + 3 * G;
                H[q + 0] = J.x;
                H[q + 1] = J.y;
                H[q + 2] = J.z
            }
        }
        f.addAttribute("position", new THREE.BufferAttribute(H, 3))
    } else {
        if (K.geometry instanceof THREE.BufferGeometry) {
            if (K.geometry.attributes.index !== undefined) {
                var n = K.geometry.attributes.position.array;
                var h = K.geometry.attributes.index.array;
                var v = K.geometry.drawcalls;
                var c = 0;
                if (v.length === 0) {
                    v = [{
                        count: h.length,
                        index: 0,
                        start: 0
                    }]
                }
                var d = new Uint32Array(2 * h.length);
                for (var C = 0, A = v.length; C < A; ++C) {
                    var e = v[C].start;
                    var p = v[C].count;
                    var q = v[C].index;
                    for (var I = e, u = e + p; I < u; I += 3) {
                        for (var G = 0; G < 3; G++) {
                            k[0] = q + h[I + G];
                            k[1] = q + h[I + (G + 1) % 3];
                            k.sort(E);
                            var L = k.toString();
                            if (a[L] === undefined) {
                                d[2 * c] = k[0];
                                d[2 * c + 1] = k[1];
                                a[L] = true;
                                c++
                            }
                        }
                    }
                }
                var H = new Float32Array(c * 2 * 3);
                for (var I = 0, D = c; I < D; I++) {
                    for (var G = 0; G < 2; G++) {
                        var q = 6 * I + 3 * G;
                        var g = 3 * d[2 * I + G];
                        H[q + 0] = n[g];
                        H[q + 1] = n[g + 1];
                        H[q + 2] = n[g + 2]
                    }
                }
                f.addAttribute("position", new THREE.BufferAttribute(H, 3))
            } else {
                var n = K.geometry.attributes.position.array;
                var c = n.length / 3;
                var s = c / 3;
                var H = new Float32Array(c * 2 * 3);
                for (var I = 0, D = s; I < D; I++) {
                    for (var G = 0; G < 3; G++) {
                        var q = 18 * I + 6 * G;
                        var m = 9 * I + 3 * G;
                        H[q + 0] = n[m];
                        H[q + 1] = n[m + 1];
                        H[q + 2] = n[m + 2];
                        var g = 9 * I + 3 * ((G + 1) % 3);
                        H[q + 3] = n[g];
                        H[q + 4] = n[g + 1];
                        H[q + 5] = n[g + 2]
                    }
                }
                f.addAttribute("position", new THREE.BufferAttribute(H, 3))
            }
        }
    }
    THREE.Line.call(this, f, new THREE.LineBasicMaterial({
        color: F
    }), THREE.LinePieces);
    this.matrix = K.matrixWorld;
    this.matrixAutoUpdate = false
};
THREE.WireframeHelper.prototype = Object.create(THREE.Line.prototype);
THREE.WireframeHelper.prototype.constructor = THREE.WireframeHelper;
THREE.ImmediateRenderObject = function() {
    THREE.Object3D.call(this);
    this.render = function(a) {}
};
THREE.ImmediateRenderObject.prototype = Object.create(THREE.Object3D.prototype);
THREE.ImmediateRenderObject.prototype.constructor = THREE.ImmediateRenderObject;
THREE.MorphBlendMesh = function(g, d) {
    THREE.Mesh.call(this, g, d);
    this.animationsMap = {};
    this.animationsList = [];
    var f = this.geometry.morphTargets.length;
    var b = "__default";
    var c = 0;
    var a = f - 1;
    var e = f / 1;
    this.createAnimation(b, c, a, e);
    this.setAnimationWeight(b, 1)
};
THREE.MorphBlendMesh.prototype = Object.create(THREE.Mesh.prototype);
THREE.MorphBlendMesh.prototype.constructor = THREE.MorphBlendMesh;
THREE.MorphBlendMesh.prototype.createAnimation = function(b, e, a, d) {
    var c = {
        startFrame: e,
        endFrame: a,
        length: a - e + 1,
        fps: d,
        duration: (a - e) / d,
        lastFrame: 0,
        currentFrame: 0,
        active: false,
        time: 0,
        direction: 1,
        weight: 1,
        directionBackwards: false,
        mirroredLoop: false
    };
    this.animationsMap[b] = c;
    this.animationsList.push(c)
};
THREE.MorphBlendMesh.prototype.autoCreateAnimations = function(c) {
    var j = /([a-z]+)_?(\d+)/;
    var b, g = {};
    var k = this.geometry;
    for (var d = 0, l = k.morphTargets.length; d < l; d++) {
        var m = k.morphTargets[d];
        var h = m.name.match(j);
        if (h && h.length > 1) {
            var a = h[1];
            var f = h[2];
            if (!g[a]) {
                g[a] = {
                    start: Infinity,
                    end: -Infinity
                }
            }
            var e = g[a];
            if (d < e.start) {
                e.start = d
            }
            if (d > e.end) {
                e.end = d
            }
            if (!b) {
                b = a
            }
        }
    }
    for (var a in g) {
        var e = g[a];
        this.createAnimation(a, e.start, e.end, c)
    }
    this.firstAnimation = b
};
THREE.MorphBlendMesh.prototype.setAnimationDirectionForward = function(a) {
    var b = this.animationsMap[a];
    if (b) {
        b.direction = 1;
        b.directionBackwards = false
    }
};
THREE.MorphBlendMesh.prototype.setAnimationDirectionBackward = function(a) {
    var b = this.animationsMap[a];
    if (b) {
        b.direction = -1;
        b.directionBackwards = true
    }
};
THREE.MorphBlendMesh.prototype.setAnimationFPS = function(a, c) {
    var b = this.animationsMap[a];
    if (b) {
        b.fps = c;
        b.duration = (b.end - b.start) / b.fps
    }
};
THREE.MorphBlendMesh.prototype.setAnimationDuration = function(a, c) {
    var b = this.animationsMap[a];
    if (b) {
        b.duration = c;
        b.fps = (b.end - b.start) / b.duration
    }
};
THREE.MorphBlendMesh.prototype.setAnimationWeight = function(a, c) {
    var b = this.animationsMap[a];
    if (b) {
        b.weight = c
    }
};
THREE.MorphBlendMesh.prototype.setAnimationTime = function(a, c) {
    var b = this.animationsMap[a];
    if (b) {
        b.time = c
    }
};
THREE.MorphBlendMesh.prototype.getAnimationTime = function(a) {
    var c = 0;
    var b = this.animationsMap[a];
    if (b) {
        c = b.time
    }
    return c
};
THREE.MorphBlendMesh.prototype.getAnimationDuration = function(a) {
    var c = -1;
    var b = this.animationsMap[a];
    if (b) {
        c = b.duration
    }
    return c
};
THREE.MorphBlendMesh.prototype.playAnimation = function(a) {
    var b = this.animationsMap[a];
    if (b) {
        b.time = 0;
        b.active = true
    } else {
        console.warn("animation[" + a + "] undefined")
    }
};
THREE.MorphBlendMesh.prototype.stopAnimation = function(a) {
    var b = this.animationsMap[a];
    if (b) {
        b.active = false
    }
};
THREE.MorphBlendMesh.prototype.update = function(h) {
    for (var c = 0, a = this.animationsList.length; c < a; c++) {
        var g = this.animationsList[c];
        if (!g.active) {
            continue
        }
        var e = g.duration / g.length;
        g.time += g.direction * h;
        if (g.mirroredLoop) {
            if (g.time > g.duration || g.time < 0) {
                g.direction *= -1;
                if (g.time > g.duration) {
                    g.time = g.duration;
                    g.directionBackwards = true
                }
                if (g.time < 0) {
                    g.time = 0;
                    g.directionBackwards = false
                }
            }
        } else {
            g.time = g.time % g.duration;
            if (g.time < 0) {
                g.time += g.duration
            }
        }
        var b = g.startFrame + THREE.Math.clamp(Math.floor(g.time / e), 0, g.length - 1);
        var f = g.weight;
        if (b !== g.currentFrame) {
            this.morphTargetInfluences[g.lastFrame] = 0;
            this.morphTargetInfluences[g.currentFrame] = 1 * f;
            this.morphTargetInfluences[b] = 0;
            g.lastFrame = g.currentFrame;
            g.currentFrame = b
        }
        var d = (g.time % e) / e;
        if (g.directionBackwards) {
            d = 1 - d
        }
        this.morphTargetInfluences[g.currentFrame] = d * f;
        this.morphTargetInfluences[g.lastFrame] = (1 - d) * f
    }
};
if (typeof exports !== "undefined") {
    if (typeof module !== "undefined" && module.exports) {
        exports = module.exports = THREE
    }
    exports.THREE = THREE
} else {
    this["THREE"] = THREE
};