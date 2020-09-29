# Yukana
いろみっけ！「いろおに」用サーバソフトウェア。

# Ding / Dong パケットのフォーマット
バイトオーダは **Big Endian**。

以下は DataPacket の数が2個の場合の DingPacket または DongPacket の送信例。

## ヘッダ部
### Magic Number (Unsigned Int 8)
- 0x0f (offset = 0)
- 0x03 (offset = 1)
- 0x0b (offset = 2)
- 0x08 (offset = 3)

### Data Packet の数 (Unsigned Int 8)
- 0x02 (offset = 4)

## データ部
> **DataPacket I**

### データの長さ (Unsigned Int 16)
- 259 (offset = 5)

### Packet ID (Unsigned Int 8)
- 0x01 (offset = 7)

### Buffer の長さ (Unsigned Int 16)
- 256 (offset = 8)

### Buffer
- 様々なデータ (offset = 10 ~ 266)

> **DataPacket II**

### データの長さ (Unsigned Int 16)
- 103 (offset = 267)

### Packet ID (Unsigned Int 8)
- 0x01 (offset = 269)

### Buffer の長さ (Unsigned Int 16)
- 100 (offset = 270)

### Buffer
- 様々なデータ (offset = 272 ~ 372)
