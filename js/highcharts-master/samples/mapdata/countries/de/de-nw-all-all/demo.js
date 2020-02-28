$(function () {

    // Prepare demo data
    var data = [
        {
            "hc-key": "de-nw-05382000-05382016",
            "value": 0
        },
        {
            "hc-key": "de-nw-05334000-05334002",
            "value": 1
        },
        {
            "hc-key": "de-nw-05758000-05758028",
            "value": 2
        },
        {
            "hc-key": "de-nw-05166000-05166012",
            "value": 3
        },
        {
            "hc-key": "de-nw-05166000-05166028",
            "value": 4
        },
        {
            "hc-key": "de-nw-05374000-05374008",
            "value": 5
        },
        {
            "hc-key": "de-nw-05374000-05374012",
            "value": 6
        },
        {
            "hc-key": "de-nw-05566000-05566016",
            "value": 7
        },
        {
            "hc-key": "de-nw-05766000-05766036",
            "value": 8
        },
        {
            "hc-key": "de-nw-05370000-05370040",
            "value": 9
        },
        {
            "hc-key": "de-nw-05362000-05362008",
            "value": 10
        },
        {
            "hc-key": "de-nw-05362000-05362016",
            "value": 11
        },
        {
            "hc-key": "de-nw-05166000-05166016",
            "value": 12
        },
        {
            "hc-key": "de-nw-05562000-05562008",
            "value": 13
        },
        {
            "hc-key": "de-nw-05562000-05562028",
            "value": 14
        },
        {
            "hc-key": "de-nw-05962000-05962028",
            "value": 15
        },
        {
            "hc-key": "de-nw-05374000-05374024",
            "value": 16
        },
        {
            "hc-key": "de-nw-05566000-05566008",
            "value": 17
        },
        {
            "hc-key": "de-nw-05566000-05566012",
            "value": 18
        },
        {
            "hc-key": "de-nw-05154000-05154032",
            "value": 19
        },
        {
            "hc-key": "de-nw-05758000-05758012",
            "value": 20
        },
        {
            "hc-key": "de-nw-05758000-05758016",
            "value": 21
        },
        {
            "hc-key": "de-nw-05758000-05758020",
            "value": 22
        },
        {
            "hc-key": "de-nw-05754000-05754008",
            "value": 23
        },
        {
            "hc-key": "de-nw-05754000-05754032",
            "value": 24
        },
        {
            "hc-key": "de-nw-05124000-05124000",
            "value": 25
        },
        {
            "hc-key": "de-nw-05374000-05374036",
            "value": 26
        },
        {
            "hc-key": "de-nw-05962000-05962012",
            "value": 27
        },
        {
            "hc-key": "de-nw-05120000-05120000",
            "value": 28
        },
        {
            "hc-key": "de-nw-05954000-05954016",
            "value": 29
        },
        {
            "hc-key": "de-nw-05554000-05554044",
            "value": 30
        },
        {
            "hc-key": "de-nw-05554000-05554016",
            "value": 31
        },
        {
            "hc-key": "de-nw-05378000-05378016",
            "value": 32
        },
        {
            "hc-key": "de-nw-05378000-05378008",
            "value": 33
        },
        {
            "hc-key": "de-nw-05766000-05766016",
            "value": 34
        },
        {
            "hc-key": "de-nw-05378000-05378020",
            "value": 35
        },
        {
            "hc-key": "de-nw-05370000-05370032",
            "value": 36
        },
        {
            "hc-key": "de-nw-05370000-05370008",
            "value": 37
        },
        {
            "hc-key": "de-nw-05554000-05554052",
            "value": 38
        },
        {
            "hc-key": "de-nw-05554000-05554036",
            "value": 39
        },
        {
            "hc-key": "de-nw-05554000-05554024",
            "value": 40
        },
        {
            "hc-key": "de-nw-05554000-05554056",
            "value": 41
        },
        {
            "hc-key": "de-nw-05162000-05162024",
            "value": 42
        },
        {
            "hc-key": "de-nw-05162000-05162020",
            "value": 43
        },
        {
            "hc-key": "de-nw-05758000-05758024",
            "value": 44
        },
        {
            "hc-key": "de-nw-05558000-05558036",
            "value": 45
        },
        {
            "hc-key": "de-nw-05562000-05562016",
            "value": 46
        },
        {
            "hc-key": "de-nw-05558000-05558016",
            "value": 47
        },
        {
            "hc-key": "de-nw-05766000-05766052",
            "value": 48
        },
        {
            "hc-key": "de-nw-05158000-05158020",
            "value": 49
        },
        {
            "hc-key": "de-nw-05762000-05762008",
            "value": 50
        },
        {
            "hc-key": "de-nw-05762000-05762016",
            "value": 51
        },
        {
            "hc-key": "de-nw-05966000-05966008",
            "value": 52
        },
        {
            "hc-key": "de-nw-05374000-05374004",
            "value": 53
        },
        {
            "hc-key": "de-nw-05566000-05566052",
            "value": 54
        },
        {
            "hc-key": "de-nw-05566000-05566084",
            "value": 55
        },
        {
            "hc-key": "de-nw-05334000-05334012",
            "value": 56
        },
        {
            "hc-key": "de-nw-05366000-05366020",
            "value": 57
        },
        {
            "hc-key": "de-nw-05366000-05366032",
            "value": 58
        },
        {
            "hc-key": "de-nw-05382000-05382020",
            "value": 59
        },
        {
            "hc-key": "de-nw-05382000-05382040",
            "value": 60
        },
        {
            "hc-key": "de-nw-05362000-05362012",
            "value": 61
        },
        {
            "hc-key": "de-nw-05382000-05382012",
            "value": 62
        },
        {
            "hc-key": "de-nw-05334000-05334020",
            "value": 63
        },
        {
            "hc-key": "de-nw-05762000-05762004",
            "value": 64
        },
        {
            "hc-key": "de-nw-05774000-05774028",
            "value": 65
        },
        {
            "hc-key": "de-nw-05774000-05774032",
            "value": 66
        },
        {
            "hc-key": "de-nw-05754000-05754040",
            "value": 67
        },
        {
            "hc-key": "de-nw-05770000-05770012",
            "value": 68
        },
        {
            "hc-key": "de-nw-05766000-05766044",
            "value": 69
        },
        {
            "hc-key": "de-nw-05954000-05954020",
            "value": 70
        },
        {
            "hc-key": "de-nw-05954000-05954032",
            "value": 71
        },
        {
            "hc-key": "de-nw-05954000-05954012",
            "value": 72
        },
        {
            "hc-key": "de-nw-05774000-05774040",
            "value": 73
        },
        {
            "hc-key": "de-nw-05774000-05774036",
            "value": 74
        },
        {
            "hc-key": "de-nw-05954000-05954028",
            "value": 75
        },
        {
            "hc-key": "de-nw-05382000-05382060",
            "value": 76
        },
        {
            "hc-key": "de-nw-05154000-05154020",
            "value": 77
        },
        {
            "hc-key": "de-nw-05154000-05154048",
            "value": 78
        },
        {
            "hc-key": "de-nw-05554000-05554004",
            "value": 79
        },
        {
            "hc-key": "de-nw-05566000-05566060",
            "value": 80
        },
        {
            "hc-key": "de-nw-05154000-05154060",
            "value": 81
        },
        {
            "hc-key": "de-nw-05970000-05970044",
            "value": 82
        },
        {
            "hc-key": "de-nw-05378000-05378032",
            "value": 83
        },
        {
            "hc-key": "de-nw-05966000-05966016",
            "value": 84
        },
        {
            "hc-key": "de-nw-05970000-05970012",
            "value": 85
        },
        {
            "hc-key": "de-nw-05315000-05315000",
            "value": 86
        },
        {
            "hc-key": "de-nw-05158000-05158026",
            "value": 87
        },
        {
            "hc-key": "de-nw-05382000-05382068",
            "value": 88
        },
        {
            "hc-key": "de-nw-05382000-05382056",
            "value": 89
        },
        {
            "hc-key": "de-nw-05966000-05966028",
            "value": 90
        },
        {
            "hc-key": "de-nw-05970000-05970040",
            "value": 91
        },
        {
            "hc-key": "de-nw-05366000-05366040",
            "value": 92
        },
        {
            "hc-key": "de-nw-05382000-05382064",
            "value": 93
        },
        {
            "hc-key": "de-nw-05970000-05970032",
            "value": 94
        },
        {
            "hc-key": "de-nw-05382000-05382024",
            "value": 95
        },
        {
            "hc-key": "de-nw-05970000-05970024",
            "value": 96
        },
        {
            "hc-key": "de-nw-05958000-05958016",
            "value": 97
        },
        {
            "hc-key": "de-nw-05966000-05966020",
            "value": 98
        },
        {
            "hc-key": "de-nw-05970000-05970004",
            "value": 99
        },
        {
            "hc-key": "de-nw-05966000-05966024",
            "value": 100
        },
        {
            "hc-key": "de-nw-05974000-05974036",
            "value": 101
        },
        {
            "hc-key": "de-nw-05958000-05958012",
            "value": 102
        },
        {
            "hc-key": "de-nw-05774000-05774016",
            "value": 103
        },
        {
            "hc-key": "de-nw-05958000-05958004",
            "value": 104
        },
        {
            "hc-key": "de-nw-05974000-05974044",
            "value": 105
        },
        {
            "hc-key": "de-nw-05170000-05170008",
            "value": 106
        },
        {
            "hc-key": "de-nw-05112000-05112000",
            "value": 107
        },
        {
            "hc-key": "de-nw-05158000-05158028",
            "value": 108
        },
        {
            "hc-key": "de-nw-05566000-05566028",
            "value": 109
        },
        {
            "hc-key": "de-nw-05566000-05566020",
            "value": 110
        },
        {
            "hc-key": "de-nw-05382000-05382008",
            "value": 111
        },
        {
            "hc-key": "de-nw-05314000-05314000",
            "value": 112
        },
        {
            "hc-key": "de-nw-05382000-05382028",
            "value": 113
        },
        {
            "hc-key": "de-nw-05914000-05914000",
            "value": 114
        },
        {
            "hc-key": "de-nw-05954000-05954008",
            "value": 115
        },
        {
            "hc-key": "de-nw-05154000-05154064",
            "value": 116
        },
        {
            "hc-key": "de-nw-05154000-05154056",
            "value": 117
        },
        {
            "hc-key": "de-nw-05154000-05154016",
            "value": 118
        },
        {
            "hc-key": "de-nw-05154000-05154040",
            "value": 119
        },
        {
            "hc-key": "de-nw-05366000-05366036",
            "value": 120
        },
        {
            "hc-key": "de-nw-05362000-05362024",
            "value": 121
        },
        {
            "hc-key": "de-nw-05758000-05758004",
            "value": 122
        },
        {
            "hc-key": "de-nw-05758000-05758032",
            "value": 123
        },
        {
            "hc-key": "de-nw-05766000-05766064",
            "value": 124
        },
        {
            "hc-key": "de-nw-05774000-05774024",
            "value": 125
        },
        {
            "hc-key": "de-nw-05754000-05754044",
            "value": 126
        },
        {
            "hc-key": "de-nw-05962000-05962036",
            "value": 127
        },
        {
            "hc-key": "de-nw-05962000-05962032",
            "value": 128
        },
        {
            "hc-key": "de-nw-05962000-05962060",
            "value": 129
        },
        {
            "hc-key": "de-nw-05770000-05770008",
            "value": 130
        },
        {
            "hc-key": "de-nw-05166000-05166008",
            "value": 131
        },
        {
            "hc-key": "de-nw-05154000-05154028",
            "value": 132
        },
        {
            "hc-key": "de-nw-05358000-05358004",
            "value": 133
        },
        {
            "hc-key": "de-nw-05334000-05334004",
            "value": 134
        },
        {
            "hc-key": "de-nw-05554000-05554012",
            "value": 135
        },
        {
            "hc-key": "de-nw-05554000-05554048",
            "value": 136
        },
        {
            "hc-key": "de-nw-05554000-05554040",
            "value": 137
        },
        {
            "hc-key": "de-nw-05554000-05554060",
            "value": 138
        },
        {
            "hc-key": "de-nw-05554000-05554068",
            "value": 139
        },
        {
            "hc-key": "de-nw-05974000-05974056",
            "value": 140
        },
        {
            "hc-key": "de-nw-05978000-05978012",
            "value": 141
        },
        {
            "hc-key": "de-nw-05978000-05978016",
            "value": 142
        },
        {
            "hc-key": "de-nw-05362000-05362036",
            "value": 143
        },
        {
            "hc-key": "de-nw-05166000-05166032",
            "value": 144
        },
        {
            "hc-key": "de-nw-05166000-05166036",
            "value": 145
        },
        {
            "hc-key": "de-nw-05362000-05362032",
            "value": 146
        },
        {
            "hc-key": "de-nw-05978000-05978024",
            "value": 147
        },
        {
            "hc-key": "de-nw-05978000-05978020",
            "value": 148
        },
        {
            "hc-key": "de-nw-05158000-05158008",
            "value": 149
        },
        {
            "hc-key": "de-nw-05158000-05158004",
            "value": 150
        },
        {
            "hc-key": "de-nw-05558000-05558044",
            "value": 151
        },
        {
            "hc-key": "de-nw-05558000-05558028",
            "value": 152
        },
        {
            "hc-key": "de-nw-05358000-05358008",
            "value": 153
        },
        {
            "hc-key": "de-nw-05358000-05358040",
            "value": 154
        },
        {
            "hc-key": "de-nw-05962000-05962040",
            "value": 155
        },
        {
            "hc-key": "de-nw-05170000-05170024",
            "value": 156
        },
        {
            "hc-key": "de-nw-05170000-05170020",
            "value": 157
        },
        {
            "hc-key": "de-nw-05962000-05962008",
            "value": 158
        },
        {
            "hc-key": "de-nw-05378000-05378012",
            "value": 159
        },
        {
            "hc-key": "de-nw-05378000-05378024",
            "value": 160
        },
        {
            "hc-key": "de-nw-05374000-05374052",
            "value": 161
        },
        {
            "hc-key": "de-nw-05154000-05154044",
            "value": 162
        },
        {
            "hc-key": "de-nw-05158000-05158016",
            "value": 163
        },
        {
            "hc-key": "de-nw-05162000-05162028",
            "value": 164
        },
        {
            "hc-key": "de-nw-05362000-05362004",
            "value": 165
        },
        {
            "hc-key": "de-nw-05162000-05162012",
            "value": 166
        },
        {
            "hc-key": "de-nw-05358000-05358016",
            "value": 167
        },
        {
            "hc-key": "de-nw-05358000-05358020",
            "value": 168
        },
        {
            "hc-key": "de-nw-05358000-05358024",
            "value": 169
        },
        {
            "hc-key": "de-nw-05358000-05358048",
            "value": 170
        },
        {
            "hc-key": "de-nw-05566000-05566036",
            "value": 171
        },
        {
            "hc-key": "de-nw-05558000-05558040",
            "value": 172
        },
        {
            "hc-key": "de-nw-05566000-05566024",
            "value": 173
        },
        {
            "hc-key": "de-nw-05334000-05334028",
            "value": 174
        },
        {
            "hc-key": "de-nw-05334000-05334032",
            "value": 175
        },
        {
            "hc-key": "de-nw-05362000-05362020",
            "value": 176
        },
        {
            "hc-key": "de-nw-05974000-05974028",
            "value": 177
        },
        {
            "hc-key": "de-nw-05358000-05358060",
            "value": 178
        },
        {
            "hc-key": "de-nw-05358000-05358044",
            "value": 179
        },
        {
            "hc-key": "de-nw-05970000-05970036",
            "value": 180
        },
        {
            "hc-key": "de-nw-05154000-05154012",
            "value": 181
        },
        {
            "hc-key": "de-nw-05170000-05170040",
            "value": 182
        },
        {
            "hc-key": "de-nw-05766000-05766040",
            "value": 183
        },
        {
            "hc-key": "de-nw-05766000-05766048",
            "value": 184
        },
        {
            "hc-key": "de-nw-05358000-05358032",
            "value": 185
        },
        {
            "hc-key": "de-nw-05978000-05978036",
            "value": 186
        },
        {
            "hc-key": "de-nw-05974000-05974052",
            "value": 187
        },
        {
            "hc-key": "de-nw-05974000-05974040",
            "value": 188
        },
        {
            "hc-key": "de-nw-05774000-05774020",
            "value": 189
        },
        {
            "hc-key": "de-nw-05170000-05170052",
            "value": 190
        },
        {
            "hc-key": "de-nw-05154000-05154024",
            "value": 191
        },
        {
            "hc-key": "de-nw-05566000-05566040",
            "value": 192
        },
        {
            "hc-key": "de-nw-05170000-05170004",
            "value": 193
        },
        {
            "hc-key": "de-nw-05170000-05170048",
            "value": 194
        },
        {
            "hc-key": "de-nw-05382000-05382076",
            "value": 195
        },
        {
            "hc-key": "de-nw-05374000-05374028",
            "value": 196
        },
        {
            "hc-key": "de-nw-05366000-05366044",
            "value": 197
        },
        {
            "hc-key": "de-nw-05358000-05358012",
            "value": 198
        },
        {
            "hc-key": "de-nw-05566000-05566032",
            "value": 199
        },
        {
            "hc-key": "de-nw-05566000-05566044",
            "value": 200
        },
        {
            "hc-key": "de-nw-05116000-05116000",
            "value": 201
        },
        {
            "hc-key": "de-nw-05166000-05166024",
            "value": 202
        },
        {
            "hc-key": "de-nw-05166000-05166020",
            "value": 203
        },
        {
            "hc-key": "de-nw-05962000-05962044",
            "value": 204
        },
        {
            "hc-key": "de-nw-05962000-05962056",
            "value": 205
        },
        {
            "hc-key": "de-nw-05170000-05170012",
            "value": 206
        },
        {
            "hc-key": "de-nw-05554000-05554032",
            "value": 207
        },
        {
            "hc-key": "de-nw-05334000-05334024",
            "value": 208
        },
        {
            "hc-key": "de-nw-05382000-05382044",
            "value": 209
        },
        {
            "hc-key": "de-nw-05154000-05154052",
            "value": 210
        },
        {
            "hc-key": "de-nw-05566000-05566072",
            "value": 211
        },
        {
            "hc-key": "de-nw-05170000-05170028",
            "value": 212
        },
        {
            "hc-key": "de-nw-05766000-05766008",
            "value": 213
        },
        {
            "hc-key": "de-nw-05711000-05711000",
            "value": 214
        },
        {
            "hc-key": "de-nw-05122000-05122000",
            "value": 215
        },
        {
            "hc-key": "de-nw-05158000-05158032",
            "value": 216
        },
        {
            "hc-key": "de-nw-05978000-05978008",
            "value": 217
        },
        {
            "hc-key": "de-nw-05113000-05113000",
            "value": 218
        },
        {
            "hc-key": "de-nw-05382000-05382048",
            "value": 219
        },
        {
            "hc-key": "de-nw-05366000-05366004",
            "value": 220
        },
        {
            "hc-key": "de-nw-05382000-05382004",
            "value": 221
        },
        {
            "hc-key": "de-nw-05370000-05370012",
            "value": 222
        },
        {
            "hc-key": "de-nw-05334000-05334008",
            "value": 223
        },
        {
            "hc-key": "de-nw-05358000-05358036",
            "value": 224
        },
        {
            "hc-key": "de-nw-05366000-05366012",
            "value": 225
        },
        {
            "hc-key": "de-nw-05162000-05162004",
            "value": 226
        },
        {
            "hc-key": "de-nw-05770000-05770024",
            "value": 227
        },
        {
            "hc-key": "de-nw-05770000-05770004",
            "value": 228
        },
        {
            "hc-key": "de-nw-05362000-05362040",
            "value": 229
        },
        {
            "hc-key": "de-nw-05962000-05962016",
            "value": 230
        },
        {
            "hc-key": "de-nw-05962000-05962048",
            "value": 231
        },
        {
            "hc-key": "de-nw-05766000-05766020",
            "value": 232
        },
        {
            "hc-key": "de-nw-05766000-05766004",
            "value": 233
        },
        {
            "hc-key": "de-nw-05766000-05766056",
            "value": 234
        },
        {
            "hc-key": "de-nw-05762000-05762024",
            "value": 235
        },
        {
            "hc-key": "de-nw-05762000-05762028",
            "value": 236
        },
        {
            "hc-key": "de-nw-05766000-05766060",
            "value": 237
        },
        {
            "hc-key": "de-nw-05766000-05766032",
            "value": 238
        },
        {
            "hc-key": "de-nw-05770000-05770036",
            "value": 239
        },
        {
            "hc-key": "de-nw-05558000-05558008",
            "value": 240
        },
        {
            "hc-key": "de-nw-05558000-05558020",
            "value": 241
        },
        {
            "hc-key": "de-nw-05114000-05114000",
            "value": 242
        },
        {
            "hc-key": "de-nw-05913000-05913000",
            "value": 243
        },
        {
            "hc-key": "de-nw-05562000-05562036",
            "value": 244
        },
        {
            "hc-key": "de-nw-05562000-05562004",
            "value": 245
        },
        {
            "hc-key": "de-nw-05978000-05978032",
            "value": 246
        },
        {
            "hc-key": "de-nw-05558000-05558024",
            "value": 247
        },
        {
            "hc-key": "de-nw-05974000-05974016",
            "value": 248
        },
        {
            "hc-key": "de-nw-05974000-05974020",
            "value": 249
        },
        {
            "hc-key": "de-nw-05566000-05566068",
            "value": 250
        },
        {
            "hc-key": "de-nw-05754000-05754028",
            "value": 251
        },
        {
            "hc-key": "de-nw-05754000-05754024",
            "value": 252
        },
        {
            "hc-key": "de-nw-05570000-05570028",
            "value": 253
        },
        {
            "hc-key": "de-nw-05570000-05570036",
            "value": 254
        },
        {
            "hc-key": "de-nw-05754000-05754016",
            "value": 255
        },
        {
            "hc-key": "de-nw-05754000-05754012",
            "value": 256
        },
        {
            "hc-key": "de-nw-05562000-05562012",
            "value": 257
        },
        {
            "hc-key": "de-nw-05374000-05374048",
            "value": 258
        },
        {
            "hc-key": "de-nw-05382000-05382036",
            "value": 259
        },
        {
            "hc-key": "de-nw-05962000-05962004",
            "value": 260
        },
        {
            "hc-key": "de-nw-05374000-05374032",
            "value": 261
        },
        {
            "hc-key": "de-nw-05382000-05382052",
            "value": 262
        },
        {
            "hc-key": "de-nw-05374000-05374044",
            "value": 263
        },
        {
            "hc-key": "de-nw-05558000-05558032",
            "value": 264
        },
        {
            "hc-key": "de-nw-05566000-05566004",
            "value": 265
        },
        {
            "hc-key": "de-nw-05758000-05758036",
            "value": 266
        },
        {
            "hc-key": "de-nw-05117000-05117000",
            "value": 267
        },
        {
            "hc-key": "de-nw-05962000-05962052",
            "value": 268
        },
        {
            "hc-key": "de-nw-05774000-05774012",
            "value": 269
        },
        {
            "hc-key": "de-nw-05974000-05974032",
            "value": 270
        },
        {
            "hc-key": "de-nw-05974000-05974008",
            "value": 271
        },
        {
            "hc-key": "de-nw-05974000-05974024",
            "value": 272
        },
        {
            "hc-key": "de-nw-05374000-05374016",
            "value": 273
        },
        {
            "hc-key": "de-nw-05334000-05334016",
            "value": 274
        },
        {
            "hc-key": "de-nw-05370000-05370028",
            "value": 275
        },
        {
            "hc-key": "de-nw-05958000-05958044",
            "value": 276
        },
        {
            "hc-key": "de-nw-05170000-05170016",
            "value": 277
        },
        {
            "hc-key": "de-nw-05512000-05512000",
            "value": 278
        },
        {
            "hc-key": "de-nw-05170000-05170036",
            "value": 279
        },
        {
            "hc-key": "de-nw-05566000-05566056",
            "value": 280
        },
        {
            "hc-key": "de-nw-05758000-05758008",
            "value": 281
        },
        {
            "hc-key": "de-nw-05966000-05966004",
            "value": 282
        },
        {
            "hc-key": "de-nw-05754000-05754036",
            "value": 283
        },
        {
            "hc-key": "de-nw-05958000-05958040",
            "value": 284
        },
        {
            "hc-key": "de-nw-05958000-05958008",
            "value": 285
        },
        {
            "hc-key": "de-nw-05958000-05958036",
            "value": 286
        },
        {
            "hc-key": "de-nw-05970000-05970016",
            "value": 287
        },
        {
            "hc-key": "de-nw-05554000-05554020",
            "value": 288
        },
        {
            "hc-key": "de-nw-05554000-05554064",
            "value": 289
        },
        {
            "hc-key": "de-nw-05762000-05762020",
            "value": 290
        },
        {
            "hc-key": "de-nw-05370000-05370016",
            "value": 291
        },
        {
            "hc-key": "de-nw-05370000-05370024",
            "value": 292
        },
        {
            "hc-key": "de-nw-05370000-05370020",
            "value": 293
        },
        {
            "hc-key": "de-nw-05382000-05382032",
            "value": 294
        },
        {
            "hc-key": "de-nw-05513000-05513000",
            "value": 295
        },
        {
            "hc-key": "de-nw-05911000-05911000",
            "value": 296
        },
        {
            "hc-key": "de-nw-05570000-05570024",
            "value": 297
        },
        {
            "hc-key": "de-nw-05515000-05515000",
            "value": 298
        },
        {
            "hc-key": "de-nw-05558000-05558004",
            "value": 299
        },
        {
            "hc-key": "de-nw-05770000-05770016",
            "value": 300
        },
        {
            "hc-key": "de-nw-05570000-05570032",
            "value": 301
        },
        {
            "hc-key": "de-nw-05570000-05570004",
            "value": 302
        },
        {
            "hc-key": "de-nw-05158000-05158036",
            "value": 303
        },
        {
            "hc-key": "de-nw-05158000-05158012",
            "value": 304
        },
        {
            "hc-key": "de-nw-05915000-05915000",
            "value": 305
        },
        {
            "hc-key": "de-nw-05154000-05154004",
            "value": 306
        },
        {
            "hc-key": "de-nw-05754000-05754052",
            "value": 307
        },
        {
            "hc-key": "de-nw-05366000-05366016",
            "value": 308
        },
        {
            "hc-key": "de-nw-05366000-05366028",
            "value": 309
        },
        {
            "hc-key": "de-nw-05566000-05566092",
            "value": 310
        },
        {
            "hc-key": "de-nw-05566000-05566088",
            "value": 311
        },
        {
            "hc-key": "de-nw-05566000-05566048",
            "value": 312
        },
        {
            "hc-key": "de-nw-05358000-05358028",
            "value": 313
        },
        {
            "hc-key": "de-nw-05358000-05358052",
            "value": 314
        },
        {
            "hc-key": "de-nw-05566000-05566080",
            "value": 315
        },
        {
            "hc-key": "de-nw-05762000-05762012",
            "value": 316
        },
        {
            "hc-key": "de-nw-05316000-05316000",
            "value": 317
        },
        {
            "hc-key": "de-nw-05378000-05378004",
            "value": 318
        },
        {
            "hc-key": "de-nw-05370000-05370036",
            "value": 319
        },
        {
            "hc-key": "de-nw-05370000-05370004",
            "value": 320
        },
        {
            "hc-key": "de-nw-05358000-05358056",
            "value": 321
        },
        {
            "hc-key": "de-nw-05111000-05111000",
            "value": 322
        },
        {
            "hc-key": "de-nw-05162000-05162008",
            "value": 323
        },
        {
            "hc-key": "de-nw-05570000-05570048",
            "value": 324
        },
        {
            "hc-key": "de-nw-05570000-05570008",
            "value": 325
        },
        {
            "hc-key": "de-nw-05158000-05158024",
            "value": 326
        },
        {
            "hc-key": "de-nw-05962000-05962020",
            "value": 327
        },
        {
            "hc-key": "de-nw-05562000-05562032",
            "value": 328
        },
        {
            "hc-key": "de-nw-05754000-05754048",
            "value": 329
        },
        {
            "hc-key": "de-nw-05554000-05554028",
            "value": 330
        },
        {
            "hc-key": "de-nw-05570000-05570012",
            "value": 331
        },
        {
            "hc-key": "de-nw-05570000-05570020",
            "value": 332
        },
        {
            "hc-key": "de-nw-05770000-05770032",
            "value": 333
        },
        {
            "hc-key": "de-nw-05570000-05570040",
            "value": 334
        },
        {
            "hc-key": "de-nw-05974000-05974012",
            "value": 335
        },
        {
            "hc-key": "de-nw-05374000-05374040",
            "value": 336
        },
        {
            "hc-key": "de-nw-05762000-05762032",
            "value": 337
        },
        {
            "hc-key": "de-nw-05774000-05774004",
            "value": 338
        },
        {
            "hc-key": "de-nw-05954000-05954024",
            "value": 339
        },
        {
            "hc-key": "de-nw-05170000-05170032",
            "value": 340
        },
        {
            "hc-key": "de-nw-05374000-05374020",
            "value": 341
        },
        {
            "hc-key": "de-nw-05558000-05558012",
            "value": 342
        },
        {
            "hc-key": "de-nw-05774000-05774008",
            "value": 343
        },
        {
            "hc-key": "de-nw-05954000-05954004",
            "value": 344
        },
        {
            "hc-key": "de-nw-05570000-05570052",
            "value": 345
        },
        {
            "hc-key": "de-nw-05754000-05754020",
            "value": 346
        },
        {
            "hc-key": "de-nw-05334000-05334036",
            "value": 347
        },
        {
            "hc-key": "de-nw-05570000-05570044",
            "value": 348
        },
        {
            "hc-key": "de-nw-05562000-05562014",
            "value": 349
        },
        {
            "hc-key": "de-nw-05162000-05162022",
            "value": 350
        },
        {
            "hc-key": "de-nw-05978000-05978040",
            "value": 351
        },
        {
            "hc-key": "de-nw-05562000-05562024",
            "value": 352
        },
        {
            "hc-key": "de-nw-05916000-05916000",
            "value": 353
        },
        {
            "hc-key": "de-nw-05562000-05562020",
            "value": 354
        },
        {
            "hc-key": "de-nw-05962000-05962024",
            "value": 355
        },
        {
            "hc-key": "de-nw-05154000-05154036",
            "value": 356
        },
        {
            "hc-key": "de-nw-05958000-05958020",
            "value": 357
        },
        {
            "hc-key": "de-nw-05958000-05958048",
            "value": 358
        },
        {
            "hc-key": "de-nw-05754000-05754004",
            "value": 359
        },
        {
            "hc-key": "de-nw-05770000-05770028",
            "value": 360
        },
        {
            "hc-key": "de-nw-05970000-05970028",
            "value": 361
        },
        {
            "hc-key": "de-nw-05970000-05970008",
            "value": 362
        },
        {
            "hc-key": "de-nw-05766000-05766012",
            "value": 363
        },
        {
            "hc-key": "de-nw-05958000-05958024",
            "value": 364
        },
        {
            "hc-key": "de-nw-05762000-05762036",
            "value": 365
        },
        {
            "hc-key": "de-nw-05154000-05154008",
            "value": 366
        },
        {
            "hc-key": "de-nw-05366000-05366008",
            "value": 367
        },
        {
            "hc-key": "de-nw-05554000-05554008",
            "value": 368
        },
        {
            "hc-key": "de-nw-05382000-05382072",
            "value": 369
        },
        {
            "hc-key": "de-nw-05770000-05770044",
            "value": 370
        },
        {
            "hc-key": "de-nw-05566000-05566096",
            "value": 371
        },
        {
            "hc-key": "de-nw-05766000-05766028",
            "value": 372
        },
        {
            "hc-key": "de-nw-05958000-05958028",
            "value": 373
        },
        {
            "hc-key": "de-nw-05958000-05958032",
            "value": 374
        },
        {
            "hc-key": "de-nw-05166000-05166004",
            "value": 375
        },
        {
            "hc-key": "de-nw-05770000-05770040",
            "value": 376
        },
        {
            "hc-key": "de-nw-05362000-05362028",
            "value": 377
        },
        {
            "hc-key": "de-nw-05566000-05566064",
            "value": 378
        },
        {
            "hc-key": "de-nw-05366000-05366024",
            "value": 379
        },
        {
            "hc-key": "de-nw-05966000-05966012",
            "value": 380
        },
        {
            "hc-key": "de-nw-05162000-05162016",
            "value": 381
        },
        {
            "hc-key": "de-nw-05770000-05770020",
            "value": 382
        },
        {
            "hc-key": "de-nw-05170000-05170044",
            "value": 383
        },
        {
            "hc-key": "de-nw-05974000-05974004",
            "value": 384
        },
        {
            "hc-key": "de-nw-05974000-05974048",
            "value": 385
        },
        {
            "hc-key": "de-nw-05119000-05119000",
            "value": 386
        },
        {
            "hc-key": "de-nw-05978000-05978028",
            "value": 387
        },
        {
            "hc-key": "de-nw-05954000-05954036",
            "value": 388
        },
        {
            "hc-key": "de-nw-05766000-05766024",
            "value": 389
        },
        {
            "hc-key": "de-nw-05570000-05570016",
            "value": 390
        },
        {
            "hc-key": "de-nw-05566000-05566076",
            "value": 391
        },
        {
            "hc-key": "de-nw-05970000-05970020",
            "value": 392
        },
        {
            "hc-key": "de-nw-05978000-05978004",
            "value": 393
        },
        {
            "hc-key": "de-nw-05378000-05378028",
            "value": 394
        },
        {
            "hc-key": "de-nw-05762000-05762040",
            "value": 395
        },
        {
            "value": 396
        }
    ];

    // Initiate the chart
    $('#container').highcharts('Map', {

        title : {
            text : 'Highmaps basic demo'
        },

        subtitle : {
            text : 'Source map: <a href="https://code.highcharts.com/mapdata/countries/de/de-nw-all-all.js">Nordrhein-Westfalen</a>'
        },

        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },

        colorAxis: {
            min: 0
        },

        series : [{
            data : data,
            mapData: Highcharts.maps['countries/de/de-nw-all-all'],
            joinBy: 'hc-key',
            name: 'Random data',
            states: {
                hover: {
                    color: '#a4edba'
                }
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }]
    });
});