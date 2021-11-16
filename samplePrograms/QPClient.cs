using System;
using System.Collections.Specialized;
using System.Net;
using System.Text;

class QPClient
{
    static void Main(string[] args)
    {
        using (var wb = new WebClient())
        {
            var data = new NameValueCollection();
            data["order"] = "9876543";
            data["name"] = "IBM Corporation";
            data["amount"] = "7543.21";

            var response = wb.UploadValues("http://blitz.cs.niu.edu/PurchaseOrder/", "POST", data);

            Console.WriteLine(Encoding.UTF8.GetString(response));
            Console.ReadKey();
        }
    }
}