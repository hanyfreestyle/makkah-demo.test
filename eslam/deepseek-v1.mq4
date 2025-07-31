//+------------------------------------------------------------------+
//|                     Amro_magnetic.mq4 - نسخة محسنة               |
//|                     مؤشر المغناطيس - إصدار معدل                  |
//|                     مع الحفاظ على جميع الميزات الأصلية           |
//+------------------------------------------------------------------+
#property copyright "حقوق النشر © 2011، برمجيات عوض كاب"
#property link      ""
#property indicator_chart_window
#property strict

// إعدادات الوقت
input group "إعدادات الوقت"
input int    time_hour = 0;                // الساعة الأساسية للحسابات
input int    start_week_day = 1;           // يوم بداية الأسبوع (1=الإثنين)
input int    start_week_hour = 0;          // ساعة بداية الأسبوع
input int    end_week_bar_missing = 1;     // الأشرطة المفقودة في نهاية الأسبوع
input int    Nbars_of_day = 1;             // عدد الأيام للحساب

// إعدادات مظهر الخطوط: H1-H5
input group "إعدادات مظهر الخطوط: H1-H5"
input color  color1 = Green;               // لون خطوط H1-H5
input int    width1 = 2;                   // سمك خطوط H1-H5
input int    style1 = 0;                   // نمط خطوط H1-H5 (0=صلب)

// إعدادات مظهر الخطوط: H10-H14
input group "إعدادات مظهر الخطوط: H10-H14"
input color  color2 = LightGreen;          // لون خطوط H10-H14
input int    width2 = 2;                   // سمك خطوط H10-H14
input int    style2 = 0;                   // نمط خطوط H10-H14

// إعدادات مظهر الخطوط: L1-L5
input group "إعدادات مظهر الخطوط: L1-L5"
input color  color3 = Pink;                // لون خطوط L1-L5
input int    width3 = 2;                   // سمك خطوط L1-L5
input int    style3 = 0;                   // نمط خطوط L1-L5

// إعدادات مظهر الخطوط: L10-L14
input group "إعدادات مظهر الخطوط: L10-L14"
input color  color4 = Red;                 // لون خطوط L10-L14
input int    width4 = 2;                   // سمك خطوط L10-L14
input int    style4 = 0;                   // نمط خطوط L10-L14

// إعدادات المستطيلات
input group "إعدادات المستطيلات"
input color  Rec_color1 = Gray;            // لون المستطيل الأول
input color  Rec_color2 = PaleGoldenrod;   // لون المستطيل الثاني

// إعدادات عرض الملصقات
input group "إعدادات عرض الملصقات"
input bool   show_price_Label = true;      // عرض ملصقات الأسعار
input int    size = 1;                     // حجم ملصقات الأسعار
input int    x_dis_LL = 7;                 // إزالة أفقية لملصقات LL
input int    x_dis_HL = 1;                 // إزالة أفقية لملصقات HL

// إعدادات النصوص
input group "إعدادات النصوص"
input int    corner = 0;                   // زاوية عرض المعلومات (0=أعلى يسار)

// إعدادات العمود الأول
input group "إعدادات العمود الأول"
input int    xdis1 = 10;                   // الإزالة الأفقية للعمود الأول
input int    ydis1 = 10;                   // الإزالة الرأسية للعمود الأول
input int    font_size1 = 10;              // حجم خط العمود الأول
input string font_type1 = "Arial";         // نوع خط العمود الأول
input color  font_color1 = Lime;           // لون خط العمود الأول

// إعدادات العمود الثاني
input group "إعدادات العمود الثاني"
input int    xdis2 = 70;                   // الإزالة الأفقية للعمود الثاني
input int    ydis2 = 10;                   // الإزالة الرأسية للعمود الثاني
input int    font_size2 = 10;              // حجم خط العمود الثاني
input string font_type2 = "Arial";         // نوع خط العمود الثاني
input color  font_color2 = Yellow;         // لون خط العمود الثاني

// إعدادات التنظيف
input group "إعدادات التنظيف"
input bool   Del_All_Objects = false;      // حذف جميع الكائنات عند الخروج

// المتغيرات العامة
static int day = 0;
static int valid = 0;
static double high = 0, low = 0;

//+------------------------------------------------------------------+
//| دالة التهيئة                                                     |
//+------------------------------------------------------------------+
int OnInit()
{
   return(INIT_SUCCEEDED);
}

//+------------------------------------------------------------------+
//| دالة إلغاء التهيئة                                               |
//+------------------------------------------------------------------+
void OnDeinit(const int reason)
{
   if(Del_All_Objects) DeleteAllObjects();
}

//+------------------------------------------------------------------+
//| الدالة الرئيسية للتحديث                                          |
//+------------------------------------------------------------------+
int OnCalculate(const int rates_total,
                const int prev_calculated,
                const datetime &time[],
                const double &open[],
                const double &high[],
                const double &low[],
                const double &close[],
                const long &tick_volume[],
                const long &volume[],
                const int &spread[])
{
   if(Period() != PERIOD_H1) return(0);

   if(TimeDay(Time[0]) != day)
   {
      DeleteAllObjects();
      day = TimeDay(Time[0]);
   }
   else return(0);

   CalculateAndDrawLevels();
   DisplayInfo();

   return(rates_total);
}

//+------------------------------------------------------------------+
//| حساب ورسم جميع المستويات والكائنات                               |
//+------------------------------------------------------------------+
void CalculateAndDrawLevels()
{
   int Nbars = Nbars_of_day * 24; // عدد الأشرطة المطلوبة للحساب
   const double gn1 = 1.618033989; // النسبة الذهبية 1
   const double gn2 = 0.618033989; // النسبة الذهبية 2
   double dig = (Digits == 2 || Digits == 4) ? 10 : 1; // تعديل للأرقام العشرية

   for(int i = Nbars; i >= 0; i--)
   {
      int barT1 = iBarShift(Symbol(), PERIOD_H1, Time[i], false);

      if(TimeHour(Time[barT1]) == time_hour ||
         (TimeDayOfWeek(Time[barT1]) == start_week_day && TimeHour(Time[barT1]) == start_week_hour))
      {
         // حساب النطاق الزمني للأعلى والأدنى
         int dd = (TimeDayOfWeek(Time[i]) == start_week_day) ? 24 - end_week_bar_missing : 24;

         // الحصول على أعلى وأقل سعر للنطاق الزمني
         high = iHigh(Symbol(), PERIOD_H1, iHighest(Symbol(), PERIOD_H1, MODE_HIGH, dd, barT1 + 1));
         low = iLow(Symbol(), PERIOD_H1, iLowest(Symbol(), PERIOD_H1, MODE_LOW, dd, barT1 + 1));

         // تعديل القيم حسب عدد الخانات العشرية
         high = NormalizeDouble(high / Point, Digits) * dig;
         low = NormalizeDouble(low / Point, Digits) * dig;

         // حساب النطاق والمستويات الذهبية
         double range = high - low;
         double golden_range = (MathSqrt(range + (range * gn2))) * 10;

         // حساب المستويات الخمسة الأولى
         double rang[5];
         rang[0] = golden_range * gn1;
         rang[1] = golden_range * (gn1 + 1);
         rang[2] = golden_range * (gn1 + 2);
         rang[3] = golden_range * (gn1 + 3);
         rang[4] = golden_range * (gn1 + 4);

         // حساب جميع مستويات HL و LL
         double HL[14], LL[14];
         CalculateLevels(HL, LL, high, low, rang[0], rang[1], rang[2], rang[3], rang[4]);

         // رسم جميع الكائنات
         DrawAllObjects(barT1, i, HL, LL, dig);

         if(barT1 <= 23)
         {
            valid = barT1;
            DisplayRangeInfo(rang[0], rang[1], rang[2], rang[3], rang[4], dig);
         }
      }
   }
}

//+------------------------------------------------------------------+
//| حساب جميع مستويات HL و LL                                        |
//+------------------------------------------------------------------+
void CalculateLevels(double &HL[], double &LL[], double high, double low, double r1, double r2, double r3, double r4, double r5)
{
   // مستويات HL (المستويات العليا)
   HL[0] = high + r1;   // HL1
   HL[1] = high + r2;   // HL2
   HL[2] = high + r3;   // HL3
   HL[3] = high + r4;   // HL4
   HL[4] = high + r5;   // HL5
   HL[5] = high - r1;   // HL10
   HL[6] = high - r2;   // HL11
   HL[7] = high - r3;   // HL12
   HL[8] = high - r4;   // HL13
   HL[9] = high - r5;   // HL14

   // مستويات LL (المستويات الدنيا)
   LL[0] = low + r1;    // LL1
   LL[1] = low + r2;    // LL2
   LL[2] = low + r3;    // LL3
   LL[3] = low + r4;    // LL4
   LL[4] = low + r5;    // LL5
   LL[5] = low - r1;    // LL10
   LL[6] = low - r2;    // LL11
   LL[7] = low - r3;    // LL12
   LL[8] = low - r4;    // LL13
   LL[9] = low - r5;    // LL14
}

//+------------------------------------------------------------------+
//| رسم جميع خطوط الاتجاه والمستطيلات وملصقات الأسعار               |
//+------------------------------------------------------------------+
void DrawAllObjects(int barT1, int i, double &HL[], double &LL[], double dig)
{
   string dateStr = TimeToStr(Time[i], TIME_DATE);

   // رسم خطوط HL (H1-H5)
   for(int j = 0; j < 5; j++)
   {
      string hlName = "HL" + IntegerToString(j + 1) + " " + dateStr;
      double price = NormalizeDouble(HL[j] * Point / dig, Digits);
      Tline(hlName, barT1, price, width1, color1, style1, "= " + DoubleToStr(price, Digits));
   }

   // رسم خطوط HL (H10-H14)
   for(int j = 5; j < 10; j++)
   {
      string hlName = "HL" + IntegerToString(j + 5) + " " + dateStr;
      double price = NormalizeDouble(HL[j] * Point / dig, Digits);
      string desc = (j == 5) ? "= " + DoubleToStr(price, Digits) + "\n منطقة الجذب = " + DoubleToStr((LL[0] - HL[5]) / dig, 0) + " نقطة"
                           : "= " + DoubleToStr(price, Digits);
      Tline(hlName, barT1, price, width2, color2, style2, desc);
   }

   // رسم خطوط LL (L1-L5)
   for(int j = 0; j < 5; j++)
   {
      string llName = "LL" + IntegerToString(j + 1) + " " + dateStr;
      double price = NormalizeDouble(LL[j] * Point / dig, Digits);
      string desc = (j == 0) ? "= " + DoubleToStr(price, Digits) + "\n منطقة الجذب = " + DoubleToStr((LL[0] - HL[5]) / dig, 0) + " نقطة"
                           : "= " + DoubleToStr(price, Digits);
      Tline(llName, barT1, price, width3, color3, style3, desc);
   }

   // رسم خطوط LL (L10-L14)
   for(int j = 5; j < 10; j++)
   {
      string llName = "LL" + IntegerToString(j + 5) + " " + dateStr;
      double price = NormalizeDouble(LL[j] * Point / dig, Digits);
      Tline(llName, barT1, price, width4, color4, style4, "= " + DoubleToStr(price, Digits));
   }

   // رسم مستطيل منطقة الجذب
   color recColor = (HL[5] < LL[0]) ? Rec_color1 : Rec_color2;
   Rec("منطقة الجذب " + dateStr, i, NormalizeDouble(HL[5] * Point / dig, Digits),
       NormalizeDouble(LL[0] * Point / dig, Digits), 1, recColor, 0);

   // رسم ملصقات الأسعار إذا كانت مفعلة
   if(show_price_Label && barT1 <= 23)
   {
      int addL, addH;
      if(time_hour > 0) {
         addL = 86400 + x_dis_LL * 3600; // 86400 ثانية = 24 ساعة
         addH = 86400 + x_dis_HL * 3600;
      }
      else {
         addL = 86400 + x_dis_LL * 3600;
         addH = 86400 + x_dis_HL * 3600;
      }

      // رسم ملصقات أسعار LL
      for(int j = 0; j < 10; j++)
      {
         string priceName = (j < 5) ? "price_LL" + IntegerToString(j + 1) : "price_LL" + IntegerToString(j + 5);
         double price = NormalizeDouble(LL[j] * Point / dig, Digits);
         color clr = (j < 5) ? color3 : color4;
         drawPrice(priceName, price, clr, size, (j == 0) ? 0 : 1, i, addL);
      }

      // رسم ملصقات أسعار HL
      for(int j = 0; j < 10; j++)
      {
         string priceName = (j < 5) ? "price_HL" + IntegerToString(j + 1) : "price_HL" + IntegerToString(j + 5);
         double price = NormalizeDouble(HL[j] * Point / dig, Digits);
         color clr = (j < 5) ? color1 : color2;
         drawPrice(priceName, price, clr, size, 1, i, addH);
      }
   }
}

//+------------------------------------------------------------------+
//| عرض معلومات النطاق في الزاوية                                    |
//+------------------------------------------------------------------+
void DisplayRangeInfo(double r1, double r2, double r3, double r4, double r5, double dig)
{
   // عناوين العمود الأول
   string labels[] = {"النطاق 1", "النطاق 2", "النطاق 3", "النطاق 4", "النطاق 5",
                     "نطاق اليوم", "نطاق اليوم السابق", "=======", "أعلى سعر أسبوعي", "أقل سعر أسبوعي", "سعر الافتتاح الأسبوعي"};

   for(int i = 0; i < ArraySize(labels); i++)
   {
      drawL("Range" + IntegerToString(i + 1), xdis1, ydis1 + 20 * i, labels[i], font_size1, font_type1, font_color1, corner);
   }

   // قيم العمود الثاني
   drawL("Range12", xdis2, ydis2, DoubleToStr(r1 / dig, 0), font_size2, font_type2, font_color2, corner);
   drawL("Range22", xdis2, ydis2 + 20, DoubleToStr(r2 / dig, 0), font_size2, font_type2, font_color2, corner);
   drawL("Range32", xdis2, ydis2 + 40, DoubleToStr(r3 / dig, 0), font_size2, font_type2, font_color2, corner);
   drawL("Range42", xdis2, ydis2 + 60, DoubleToStr(r4 / dig, 0), font_size2, font_type2, font_color2, corner);
   drawL("Range52", xdis2, ydis2 + 80, DoubleToStr(r5 / dig, 0), font_size2, font_type2, font_color2, corner);

   drawL("Pre_day_Range_", xdis2 + 35, ydis2 + 120, DoubleToStr((high - low) / dig, 0), font_size2, font_type2, font_color2, corner);

   drawL("Pw_Highh", xdis2, ydis2 + 160, DoubleToStr(trim(high), 0), font_size2, font_type2, font_color2, corner);
   drawL("Pw_Loww", xdis2, ydis2 + 180, DoubleToStr(trim(low), 0), font_size2, font_type2, font_color2, corner);
   drawL("Pw_Openn", xdis2, ydis2 + 200, DoubleToStr(trim(iOpen(Symbol(), PERIOD_H1, valid) / Point), 0), font_size2, font_type2, font_color2, corner);
}

//+------------------------------------------------------------------+
//| عرض معلومات نطاق اليوم                                          |
//+------------------------------------------------------------------+
void DisplayInfo()
{
   double today_h = iHigh(Symbol(), PERIOD_H1, iHighest(Symbol(), PERIOD_H1, MODE_HIGH, valid + 1, 0));
   double today_l = iLow(Symbol(), PERIOD_H1, iLowest(Symbol(), PERIOD_H1, MODE_LOW, valid + 1, 0));

   today_h = NormalizeDouble(today_h / Point, Digits);
   today_l = NormalizeDouble(today_l / Point, Digits);

   drawL("Today_Range_", xdis2 + 30, ydis2 + 100, DoubleToStr((today_h - today_l), 0), font_size2, font_type2, font_color2, corner);
}

//+------------------------------------------------------------------+
//| دالة رسم خط الاتجاه                                              |
//+------------------------------------------------------------------+
void Tline(string name, int i, double p1, int width1, color color1, int style1, string des)
{
   datetime b = CalculateEndTime(i);

   if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0)) name += " ";

   ObjectCreate(0, name, OBJ_TREND, 0, 0, 0);
   ObjectSetDouble(0, name, OBJPROP_PRICE1, p1);

   if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0))
      ObjectSetInteger(0, name, OBJPROP_TIME1, StrToTime(TimeToStr(Time[i], TIME_DATE) + " 00:00"));
   else
      ObjectSetInteger(0, name, OBJPROP_TIME1, StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + IntegerToString(time_hour) + ":00"));

   ObjectSetDouble(0, name, OBJPROP_PRICE2, p1);
   ObjectSetInteger(0, name, OBJPROP_TIME2, b);
   ObjectSetInteger(0, name, OBJPROP_RAY, (i > 23) ? false : true);
   ObjectSetInteger(0, name, OBJPROP_COLOR, color1);
   ObjectSetInteger(0, name, OBJPROP_WIDTH, width1);
   ObjectSetInteger(0, name, OBJPROP_STYLE, style1);
   ObjectSetString(0, name, OBJPROP_TEXT, des);
   ObjectSetInteger(0, name, OBJPROP_FONTSIZE, 10);
   ObjectSetString(0, name, OBJPROP_FONT, "Times New Roman");
   ObjectSetInteger(0, name, OBJPROP_BACK, true);
}

//+------------------------------------------------------------------+
//| حساب وقت النهاية للكائنات                                       |
//+------------------------------------------------------------------+
datetime CalculateEndTime(int i)
{
   if(TimeDayOfWeek(Time[i]) != start_week_day)
   {
      if(time_hour != 0)
         return StrToTime(TimeToStr(Time[i] + 86400, TIME_DATE) + " " + IntegerToString(time_hour - 1) + ":00");
      else
         return StrToTime(TimeToStr(Time[i], TIME_DATE) + " 23:00");
   }
   else
   {
      if(time_hour != 0)
      {
         if(TimeHour(Time[i]) == 0 && start_week_hour == 0)
            return StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + IntegerToString(time_hour - 1) + ":00");
         else
            return StrToTime(TimeToStr(Time[i] + 86400, TIME_DATE) + " " + IntegerToString(time_hour - 1) + ":00");
      }
      if(time_hour == 0)
         return StrToTime(TimeToStr(Time[i], TIME_DATE) + " 23:00");
   }
   return 0;
}

//+------------------------------------------------------------------+
//| دالة رسم مستطيل                                                  |
//+------------------------------------------------------------------+
void Rec(string name, int i, double p1, double p2, int width1, color color1, int style1)
{
   datetime b = CalculateEndTime(i);

   if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0)) name += " ";

   ObjectCreate(0, name, OBJ_RECTANGLE, 0, 0, 0);
   ObjectSetDouble(0, name, OBJPROP_PRICE1, p1);

   if((TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0))
      ObjectSetInteger(0, name, OBJPROP_TIME1, StrToTime(TimeToStr(Time[i], TIME_DATE) + " 00:00"));
   else
      ObjectSetInteger(0, name, OBJPROP_TIME1, StrToTime(TimeToStr(Time[i], TIME_DATE) + " " + IntegerToString(time_hour) + ":00"));

   ObjectSetDouble(0, name, OBJPROP_PRICE2, p2);
   ObjectSetInteger(0, name, OBJPROP_TIME2, b);
   ObjectSetInteger(0, name, OBJPROP_COLOR, color1);
   ObjectSetInteger(0, name, OBJPROP_WIDTH, width1);
   ObjectSetInteger(0, name, OBJPROP_STYLE, style1);
}

//+------------------------------------------------------------------+
//| دالة رسم ملصق السعر                                              |
//+------------------------------------------------------------------+
void drawPrice(string name, double p1, color color1, int width1, int style1, int i, int d)
{
   ObjectCreate(0, name, OBJ_ARROW, 0, 0, 0);
   ObjectSetInteger(0, name, OBJPROP_ARROWCODE, 6);
   ObjectSetInteger(0, name, OBJPROP_TIME1, StrToTime(TimeToStr(iTime(NULL, PERIOD_H1, i) + d, TIME_DATE|TIME_MINUTES)));
   ObjectSetDouble(0, name, OBJPROP_PRICE1, p1);
   ObjectSetInteger(0, name, OBJPROP_COLOR, color1);
   ObjectSetInteger(0, name, OBJPROP_WIDTH, width1);
   ObjectSetInteger(0, name, OBJPROP_STYLE, style1);
   ObjectSetString(0, name, OBJPROP_TEXT, DoubleToStr(p1, Digits));
   ObjectSetInteger(0, name, OBJPROP_FONTSIZE, 10);
   ObjectSetString(0, name, OBJPROP_FONT, "Arial");
}

//+------------------------------------------------------------------+
//| دالة رسم ملصق نصي                                                |
//+------------------------------------------------------------------+
void drawL(string name, int disx, int disy, string txt, int size_font, string type_font, color color1, int corner)
{
   ObjectCreate(0, name, OBJ_LABEL, 0, 0, 0);
   ObjectSetInteger(0, name, OBJPROP_XDISTANCE, disx);
   ObjectSetInteger(0, name, OBJPROP_YDISTANCE, disy);
   ObjectSetString(0, name, OBJPROP_TEXT, txt);
   ObjectSetInteger(0, name, OBJPROP_FONTSIZE, size_font);
   ObjectSetString(0, name, OBJPROP_FONT, type_font);
   ObjectSetInteger(0, name, OBJPROP_COLOR, color1);
   ObjectSetInteger(0, name, OBJPROP_CORNER, corner);
}

//+------------------------------------------------------------------+
//| دالة تقليل الرقم إلى خانة واحدة                                  |
//+------------------------------------------------------------------+
int trim(double h)
{
   double last = h;
   string no = DoubleToStr(h, 0);

   while(last > 9)
   {
      last = 0;
      for(int i = 0; i < StringLen(no); i++)
      {
         last += StringToInteger(StringSubstr(no, i, 1));
      }
      no = DoubleToStr(last, 0);
   }

   return (int)last;
}

//+------------------------------------------------------------------+
//| دالة حذف جميع الكائنات                                           |
//+------------------------------------------------------------------+
void DeleteAllObjects()
{
   for(int i = Bars; i >= 0; i--)
   {
      string suffix = (TimeDayOfWeek(Time[i]) == start_week_day && TimeHour(Time[i]) == 0) ? " " : "";
      string dateStr = TimeToStr(Time[i], TIME_DATE) + suffix;

      // حذف كائنات HL
      for(int j = 1; j <= 5; j++)
         ObjectDelete(0, "HL" + IntegerToString(j) + " " + dateStr);

      for(int j = 10; j <= 14; j++)
         ObjectDelete(0, "HL" + IntegerToString(j) + " " + dateStr);

      // حذف كائنات LL
      for(int j = 1; j <= 5; j++)
         ObjectDelete(0, "LL" + IntegerToString(j) + " " + dateStr);

      for(int j = 10; j <= 14; j++)
         ObjectDelete(0, "LL" + IntegerToString(j) + " " + dateStr);

      ObjectDelete(0, "منطقة الجذب " + dateStr);
   }

   // حذف ملصقات المعلومات
   string infoLabels[] = {"Range1", "Range12", "Range2", "Range22", "Range3", "Range32",
                         "Range4", "Range42", "Range5", "Range52", "===", "Pw_High",
                         "Pw_Low", "Pw_Open", "Pw_Highh", "Pw_Loww", "Pw_Openn",
                         "Today_Range", "Today_Range_", "Pre_day_Range_", "Pre_day_Range"};

   for(int i = 0; i < ArraySize(infoLabels); i++)
      ObjectDelete(0, infoLabels[i]);

   if(show_price_Label)
   {
      // حذف ملصقات الأسعار
      for(int j = 1; j <= 5; j++)
      {
         ObjectDelete(0, "price_LL" + IntegerToString(j));
         ObjectDelete(0, "price_HL" + IntegerToString(j));
      }

      for(int j = 10; j <= 14; j++)
      {
         ObjectDelete(0, "price_LL" + IntegerToString(j));
         ObjectDelete(0, "price_HL" + IntegerToString(j));
      }
   }
}