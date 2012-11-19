import junit.framework.Test;
import junit.framework.TestSuite;


public class AllTests {

	public static Test suite() {
		TestSuite suite = new TestSuite(AllTests.class.getName());
		//$JUnit-BEGIN$
		suite.addTestSuite(PaymentOptionActivityTest.class);
		suite.addTestSuite(PopTest.class);
		suite.addTestSuite(PizzaTest.class);
		//$JUnit-END$
		return suite;
	}

}
