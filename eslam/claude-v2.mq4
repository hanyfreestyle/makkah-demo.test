//+------------------------------------------------------------------+
//|                     ClaudeMagnet_v1.mq4                          |
//|     مؤشر خطوط دعم ومقاومة مغناطيسية - إصدار مهيكل ومعلق       |
//+------------------------------------------------------------------+
#property indicator_chart_window

//=============================
// الإعدادات العامة للمؤشر
//=============================

// سمك الخطوط
extern int LineWidth = 1;

// لون خطوط LL (الدعم)
extern color Color_LL = Red;

// لون خطوط HL (المقاومة)
extern color Color_HL = Blue;

// نمط الخطوط (متصل، متقطع، ...)
extern ENUM_LINE_STYLE LineStyle = STYLE_SOLID;

//=============================
// مستويات الدعم والمقاومة
//=============================

// مصفوفة مستويات الدعم الأساسية LL1 ~ LL5
extern double LL[] = {0, 0, 0, 0, 0};

// مصفوفة مستويات المقاومة الأساسية HL1 ~ HL5
extern double HL[] = {0, 0, 0, 0, 0};

// مصفوفة مستويات الدعم الممتدة LL10 ~ LL14
extern double LL10[] = {0, 0, 0, 0, 0};

// مصفوفة مستويات المقاومة الممتدة HL10 ~ HL14
extern double HL10[] = {0, 0, 0, 0, 0};

//=============================
// دالة التهيئة - ترسم الخطوط عند تشغيل المؤشر
//=============================
int OnInit()
{
   ClearAllLines();  // حذف أي خطوط موجودة مسبقًا
   DrawAllLines();   // رسم جميع الخطوط الحالية من القيم
   return(INIT_SUCCEEDED);
}

//=============================
// دالة إلغاء التهيئة - حذف الخطوط عند إزالة المؤشر
//=============================
void OnDeinit(const int reason)
{
   ClearAllLines();
}

//=============================
// دالة حذف جميع الخطوط السابقة من الشارت
//=============================
void ClearAllLines()
{
   for(int i = 0; i < 5; i++)
   {
      ObjectDelete("LL_" + IntegerToString(i+1));
      ObjectDelete("HL_" + IntegerToString(i+1));
      ObjectDelete("LL10_" + IntegerToString(i+1));
      ObjectDelete("HL10_" + IntegerToString(i+1));
   }
}

//=============================
// دالة رسم جميع الخطوط الحالية
//=============================
void DrawAllLines()
{
   for(int i = 0; i < 5; i++)
   {
      DrawLine("LL_" + IntegerToString(i+1), LL[i], Color_LL);     // رسم LL
      DrawLine("HL_" + IntegerToString(i+1), HL[i], Color_HL);     // رسم HL
      DrawLine("LL10_" + IntegerToString(i+1), LL10[i], Color_LL); // رسم LL10
      DrawLine("HL10_" + IntegerToString(i+1), HL10[i], Color_HL); // رسم HL10
   }
}

//=============================
// دالة مساعدة لرسم خط واحد أفقي
//=============================
void DrawLine(string name, double price, color col)
{
   if(price == 0) return; // تجاهل القيم الفارغة

   datetime t1 = Time[0];            // بداية الخط من شمعة حالية
   datetime t2 = Time[0] + 86400;    // نهاية الخط بعد يوم (يمتد حتى آخر اليوم)

   ObjectCreate(name, OBJ_TREND, 0, t1, price, t2, price);
   ObjectSet(name, OBJPROP_COLOR, col);         // اللون
   ObjectSet(name, OBJPROP_WIDTH, LineWidth);   // السماكة
   ObjectSet(name, OBJPROP_STYLE, LineStyle);   // نمط الخط
   ObjectSet(name, OBJPROP_RAY_RIGHT, true);    // يجعل الخط ممتد يمينًا
}
